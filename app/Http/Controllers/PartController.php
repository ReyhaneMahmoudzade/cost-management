<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Exports\PartsTemplateExport;
use App\Http\Requests\StorePartRequest;
use App\Imports\PartsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Material;
use App\Models\Part;
use App\Models\Process;
use App\Models\PartMaterial;
use App\Models\PartProcess;
use Illuminate\Http\Request;
use App\Services\TableDataService;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = TableDataService::partColumn();
        $rows = Part::orderBy('id', 'desc')->get();
        $actions = TableDataService::partAction();
        $routes = TableDataService::partRoute();

        return view('parts.index', compact('columns', 'rows', 'actions', 'routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materials = Material::all();
        $processes = Process::all();
        return view('parts.create', compact('materials', 'processes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartRequest $request)
    {
        DB::transaction(function () use ($request) {

            $data = $request->validated();

            $part = Part::create([
                'name' => $data['name'],
                'code' => $data['code'],
                'group' => $data['group'] ?? '',
                'type' => $data['type'] ?? '',
                'weight' => $data['weight'],
                'area' => $data['area'],
                'perimeter' => $data['perimeter'],
                'description' => $data['description'] ?? '',
            ]);

            foreach ($data['materials'] as $material) {
                PartMaterial::create([
                    'part_id' => $part->id,
                    'material_id' => $material['material_id'],
                    'quantity' => $material['quantity'],
                ]);
            }

            foreach ($data['processes'] as $process) {
                PartProcess::create([
                    'part_id' => $part->id,
                    'process_id' => $process['process_id'],
                    'standard_quantity' => $process['standard_quantity'],
                ]);
            }
        });

        return redirect()
            ->route('parts.index')
            ->with('success', 'قطعه با موفقیت ثبت شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Part $part)
    {
        $materials = Material::all();
        $processes = Process::all();
        $part->load('partMaterials.material', 'partProcesses.process');

        return view('parts.edit', compact('part', 'materials', 'processes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePartRequest $request, Part $part)
    {
        DB::transaction(function () use ($request, $part) {

            $data = $request->validated();

            $part->update([
                'name' => $data['name'],
                'code' => $data['code'],
                'group' => $data['group'] ?? '',
                'type' => $data['type'] ?? '',
                'weight' => $data['weight'],
                'area' => $data['area'],
                'perimeter' => $data['perimeter'],
                'description' => $data['description'] ?? '',
            ]);

            $part->partMaterials()->delete();
            $part->partProcesses()->delete();

            foreach ($data['materials'] as $material) {
                PartMaterial::create([
                    'part_id' => $part->id,
                    'material_id' => $material['material_id'],
                    'quantity' => $material['quantity'],
                ]);
            }

            foreach ($data['processes'] as $process) {
                PartProcess::create([
                    'part_id' => $part->id,
                    'process_id' => $process['process_id'],
                    'standard_quantity' => $process['standard_quantity'],
                ]);
            }
        });

        return redirect()
            ->route('parts.index')
            ->with('success', 'قطعه با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Part $part)
    {
        $part->delete();

        return redirect()
            ->route('parts.index')
            ->with('success', 'قطعه با موفقیت حذف شد.');
    }

    public function getProcesses(Part $part)
    {
        $partProcesses = PartProcess::with([
            'process',
            'process.processFactors.factor'
        ])
            ->where('part_id', $part->id)
            ->get();

        return response()->json($partProcesses);
    }

    /**
     * فرم آپلود اکسل قطعات.
     */
    public function importForm()
    {
        return view('parts.import');
    }

    /**
     * دانلود قالب نمونه اکسل.
     */
    public function downloadTemplate()
    {
        return Excel::download(new PartsTemplateExport, 'parts-template.xlsx');
    }

    /**
     * ذخیره فایل اکسل و درج گروهی قطعات (فقط اطلاعات پایه).
     * سیاست A: کد تکراری رد می‌شود و گزارش داده می‌شود.
     */
    public function importStore(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:10240'],
        ], [
            'file.required' => 'فایل اکسل را انتخاب کنید.',
            'file.mimes' => 'فرمت فایل باید xlsx ،xls یا csv باشد.',
            'file.max' => 'حجم فایل حداکثر ۱۰ مگابایت باشد.',
        ]);

        try {
            $import = new PartsImport;
            Excel::import($import, $request->file('file'));
        } catch (\Throwable $e) {
            report($e);

            return redirect()
                ->route('parts.importForm')
                ->with('error', 'خطا در خواندن فایل: ' . $e->getMessage());
        }

        return redirect()
            ->route('parts.importForm')
            ->with([
                'import_created' => $import->created,
                'import_skipped' => $import->skipped,
                'import_errors' => $import->errors,
                'success' => "ایمپورت انجام شد. {$import->created} قطعه جدید ثبت شد."
                    . (count($import->skipped) ? ' ' . count($import->skipped) . ' ردیف تکراری رد شد.' : '')
                    . (count($import->errors) ? ' ' . count($import->errors) . ' ردیف خطا داشت.' : ''),
            ]);
    }
}

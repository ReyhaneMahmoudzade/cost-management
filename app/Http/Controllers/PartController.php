<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePartRequest;
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
        // dd($request->all());
        DB::transaction(function () use ($request) {

            $data = $request->validated();

            $part = Part::create([
                'name' => $data['name'],
                'code' => $data['code'],
                'group' => $data['group'],
                'type' => $data['type'],
                'weight' => $data['weight'],
                'area' => $data['area'],
                'perimeter' => $data['perimeter'],
                'description' => $data['description'],
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
}
// public function getProcesses(Part $part)
// {
//     $partProcesses = PartProcess::with([
//         'process',
//         'process.processFactors.factor'
//     ])
//     ->where('part_id', $part->id)
//     ->get();

//     return response()->json($partProcesses);
// }
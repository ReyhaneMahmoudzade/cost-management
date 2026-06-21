<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcessRequest;
use App\Models\Factor;
use App\Models\Process;
use App\Models\ProcessFactor;
use Illuminate\Http\Request;
use App\Services\TableDataService;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = TableDataService::processCcolumn();
        $rows = Process::orderBy('id', 'desc')->get();
        $actions = TableDataService::processAction();
        $routes = TableDataService::processRoute();

        return view('processes.index', compact('columns', 'rows', 'actions', 'routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $factors = Factor::all();
        return view('processes.create', compact('factors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProcessRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();

        // dd($data);
        $process = Process::create([
            'name' => $data['name'],
            'standard_unit' => $data['standard_unit'],
        ]);

        foreach ($data['factors'] as $factor) {

            ProcessFactor::create([
                'process_id' => $process->id,
                'factor_id' => $factor['factor_id'],
                'weight' => $factor['weight'],
            ]);
        }

        return redirect()
            ->route('processes.index')
            ->with('success', 'فرآیند با موفقیت ثبت شد.');
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
}

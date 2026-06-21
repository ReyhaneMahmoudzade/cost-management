<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Part;
use App\Models\Process;
use App\Models\RealFactorValue;
use App\Services\CostEstimationService;
use App\Services\TableDataService;

class RealFactorValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parts = Part::with([
            'partMaterials.material',
            'partProcesses.process.processFactors.factor',
            'partProcesses.process.processRates',


        ])->get();
        // $process = Process::with('processFactors.factor')->find(6);

        // dd($process->processFactors);        

        // dd($parts->toArray());
        $columns = TableDataService::realFactorColumn();
        $rows = Part::orderBy('id', 'desc')->get();
        $actions = TableDataService::realFactorAction();
        $routes = TableDataService::realFactorRoute();

        return view('real-factor-values.index', compact('columns', 'rows', 'actions', 'routes', 'parts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $parts = Part::with([
        //     'partMaterials.material',
        //     'partProcesses.process.processFactors.factor',
        // ])->get();

        $parts = Part::all();
        return view('real-factor-values.create', compact('parts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        foreach ($request->coefficients as $partProcessId => $factors) {

            foreach ($factors as $processFactorId => $value) {

                RealFactorValue::updateOrCreate(
                    [
                        'part_process_id' => $partProcessId,
                        'process_factor_id' => $processFactorId,
                    ],
                    [
                        'coefficient_value' => $value,
                    ]
                );
            }
        }

        return redirect()
            ->route('real-factor-values.index')
            ->with('success', 'قطعه با موفقیت ثبت شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, CostEstimationService $service)
    {

        $part = Part::with([
            'partMaterials.material',
            'partProcesses.process.activeRate',
            'partProcesses.realFactorValues.processFactor.factor',
        ])
            ->findOrFail($id);



        $result = $service->calculate($part);


        return view(
            'real-factor-values.show',
            compact('result','part')
        );
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

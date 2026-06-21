<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProcessRatesRequest;
use App\Models\Process;
use App\Models\ProcessRate;
use Illuminate\Support\Facades\DB;

class ProcessRateController extends Controller
{
    public function create()
    {
        $processes = Process::all();
        return view('process-rates.create', compact('processes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProcessRatesRequest $request)
    {
        DB::transaction(function () use ($request) {
            ProcessRate::where('process_id', $request->process_id)
                ->where('is_active', true)
                ->update(['is_active' => false]);

            ProcessRate::create([
                'process_id'    => $request->process_id,
                'rate_per_unit' => $request->rate_per_unit,
                'is_active'     => true,
            ]);
        });
        // dd()

        return redirect()
        ->route('processes.index')
        ->with('success', 'با موفقیت ثبت شد.');
    }
}

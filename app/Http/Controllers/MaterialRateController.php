<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMaterialRatesRequest;
use App\Models\Material;
use App\Models\MaterialRate;
use Illuminate\Support\Facades\DB;

class MaterialRateController extends Controller
{
    public function create()
    {
        $materials = Material::all();
        return view('material-rates.create', compact('materials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaterialRatesRequest $request)
    {
        DB::transaction(function () use ($request) {
            MaterialRate::where('material_id', $request->material_id)
                ->where('is_active', true)
                ->update(['is_active' => false]);

            MaterialRate::create([
                'material_id'    => $request->material_id,
                'rate_per_unit'  => $request->rate_per_unit,
                'is_active'      => true,
            ]);
        });

        return redirect()
            ->route('materials.index')
            ->with('success', 'نرخ ماده با موفقیت ثبت شد.');
    }
}

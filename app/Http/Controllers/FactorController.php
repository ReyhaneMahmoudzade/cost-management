<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFactorRequest;
use App\Models\Factor;
use Illuminate\Http\Request;
use App\Services\TableDataService;

class FactorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = TableDataService::factorCcolumn();
        $rows = Factor::orderBy('id', 'desc')->get();
        $actions = TableDataService::factorAction();
        $routes = TableDataService::factorRoute();

        return view('factors.index', compact('columns', 'rows', 'actions', 'routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('factors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFactorRequest $request)
    {
        $validated = $request->validated();
        Factor::create($validated);

        return redirect()
        ->route('factors.index')
        ->with('success', 'عامل موثر با موفقیت ثبت شد.');
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

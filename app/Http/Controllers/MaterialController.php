<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaterialRequest;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Services\TableDataService;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = TableDataService::materialColumn();
        $rows = Material::orderBy('id', 'desc')->get();
        $actions = TableDataService::materialAction();
        $routes = TableDataService::materialRoute();

        return view('materials.index', compact('columns', 'rows', 'actions', 'routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('materials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaterialRequest $request)
    {
        Material::create($request->validated());

        return redirect()
            ->route('materials.index')
            ->with('success', 'ماده با موفقیت ثبت شد.');
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

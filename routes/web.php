<?php

use App\Http\Controllers\FactorController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\ProcessRateController;
use App\Http\Controllers\RealFactorValueController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})-> name('home');





Route::resource('materials', MaterialController::class);
Route::resource('parts', PartController::class);
Route::resource('processes', ProcessController::class);
Route::resource('process-rates', ProcessRateController::class)->only('create','store');
Route::resource('factors', FactorController::class);
Route::resource('real-factor-values', RealFactorValueController::class);



//api
Route::get('/parts/{part}/processes', [PartController::class, 'getProcesses']);
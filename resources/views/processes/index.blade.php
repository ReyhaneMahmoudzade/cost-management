@extends('layouts.table-layout')

@section('title')
فرآیند ها
@endsection

@section('header')
    @include('partials.header')
@endsection

@section('h1', 'فرآیند ها')

@section('add_btn')
    <x-ui.button.add-btn href="{{ route('processes.create') }}" />
@endsection

@section('btn2')
    <x-ui.button.btn2 href="{{ route('process-rates.create') }}" />
@endsection

@section('table')

    @include('partials.table', [
        'columns' => $columns,
        'rows' => $rows,
        'actions' => $actions,
        'routes' => $routes,
    ])
    
@endsection

@section('script')

@endsection

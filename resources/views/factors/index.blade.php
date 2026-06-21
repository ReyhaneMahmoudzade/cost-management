@extends('layouts.table-layout')

@section('title')
    عوامل موثر
@endsection

@section('header')
    @include('partials.header')
@endsection

@section('h1', 'عوامل موثر')

@section('add_btn')
    <x-ui.button.add-btn href="{{ route('factors.create') }}" />
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

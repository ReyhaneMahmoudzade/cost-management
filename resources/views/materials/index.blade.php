@extends('layouts.table-layout')

@section('title')
    مواد اولیه
@endsection

@section('header')
    @include('partials.header')
@endsection

@section('h1', 'مواد اولیه')

@section('add_btn')
    <x-ui.button.add-btn href="{{ route('materials.create') }}" />
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

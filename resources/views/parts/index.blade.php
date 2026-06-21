@extends('layouts.table-layout')

@section('title')
    اطلاعات قطعات
@endsection

@section('header')
    @include('partials.header')
@endsection

@section('h1', 'اطلاعات قطعات')

@section('add_btn')
    <x-ui.button.add-btn href="{{ route('parts.create') }}" />
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

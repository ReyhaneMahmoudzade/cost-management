@extends('layouts.table-layout')

@section('title')
    اطلاعات قطعات
@endsection

@section('header')
    @include('partials.header')
@endsection

@section('h1', 'اطلاعات قطعات')

@section('add_btn')
    <div class="flex items-center gap-2">
        <x-ui.button.add-btn href="{{ route('parts.create') }}" />
        <a href="{{ route('parts.importForm') }}" class="px-3 py-2 rounded-xl border border-emerald-600 text-emerald-700 text-sm hover:bg-emerald-50 transition">
            آپلود اکسل
        </a>
    </div>
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

@extends('layouts.app')

@section('title')
    @yield('title')
@endsection

@section('header')
    @yield('header')
@endsection

@section('content')
    <div class="max-w-6xl mx-auto">

        <div class="mb-6 flex items-center justify-between">
            <div class="flex gap-3 items-center">
                <h1 class="text-2xl font-bold text-gray-800">@yield('h1')</h1>
                <div class="">
                    @yield('add_btn', '')
                </div>
            </div>
            <div class="">
                @yield('btn2', '')
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
            @yield('table')
        </div>

    </div>
@endsection

@section('script')
    @yield('script')
@endsection

{{-- استفاده از لایوت --}}
{{-- @extends('layouts.table-layout')

@section('title')

@endsection

@section('header')

@endsection

@section('h1', 'dddddddddddddddddd')

@section('add_btn', '')

@endsection

@section('btn2', '')

@endsection

@section('table')

@endsection

@section('script')

@endsection --}}

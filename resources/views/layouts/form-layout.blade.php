@extends('layouts.app')

@section('title')
    @yield('title')
@endsection

@section('header')
    @yield('header')
@endsection

@section('content')
    <div class="max-w-6xl mx-auto">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">@yield('h1')</h1>
            <p class="mt-1 text-sm text-gray-500">
                @yield('h1_desc')
            </p>
        </div>

        @yield('form')

    </div>
@endsection

@section('script')
    @yield('script')
@endsection

{{-- استفاده از لایوت --}}
{{-- @extends('layouts.form-layout')

@section('title')

@endsection

@section('header')

@endsection

@section('h1', 'dddddddddddddddddd')

@section('h1_desc', 'dddddddddddddddddd')

@section('form')

@endsection

@section('script')

@endsection --}}

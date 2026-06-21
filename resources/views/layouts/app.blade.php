<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    @include('partials.head')
    <title>@yield('title')</title>
</head>

<body class="bg-gray-50">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Header -->
            @yield('header')
            {{-- @include('partials.header') --}}

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6 md:p-8">
                @yield('content')
            </main>

        </div>

    </div>
    
    @yield('script')
   
</body>
</html>

{{-- استفاده از لایوت --}}
{{-- @extends('layouts.app')
@section('title', '')

@section('header')
    
@endsection

@section('content')
    
@endsection

@section('script')
    
@endsection --}}

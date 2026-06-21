@extends('layouts.form-layout')

@section('title')
    تعریف عامل جدید
@endsection

@section('header')
    @include('partials.header')
@endsection

@section('h1', 'تعریف عامل جدید')

@section('h1_desc', 'توضیحات دلخواه در صورت نیاز')

@section('form')
    <form action="{{ route('factors.store') }}" method="POST"
        class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 md:p-8 ">
        @csrf

        <x-ui.form-info h2='اطلاعات پایه' h2_desc='توضیحات دلخواه در صورت نیاز' hidden='hidden'>
            <x-form.input name='name' label='نام عامل' />
            
        </x-ui.form-info>

        <div class="flex items-center justify-end gap-3 pt-6 ">
            <x-ui.button.cancel href="{{ route('factors.index') }}"/>

            <x-ui.button.submit/>
        </div>
    </form>
@endsection

@section('script')

@endsection

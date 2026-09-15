@extends('layouts.form-layout')

@section('title')
    ویرایش عامل
@endsection

@section('header')
    @include('partials.header')
@endsection

@section('h1', 'ویرایش عامل')

@section('h1_desc', 'توضیحات دلخواه در صورت نیاز')

@section('form')
    <form action="{{ route('factors.update', $factor->id) }}" method="POST"
        class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 md:p-8 ">
        @csrf
        @method('PUT')

        <x-ui.form-info h2='اطلاعات پایه' h2_desc='توضیحات دلخواه در صورت نیاز' hidden='hidden'>
            <x-form.input name='name' label='نام عامل' :value="$factor->name" />
        </x-ui.form-info>

        <div class="flex items-center justify-end gap-3 pt-6 ">
            <x-ui.button.cancel href="{{ route('factors.index') }}"/>

            <x-ui.button.submit/>
        </div>
    </form>
@endsection

@section('script')

@endsection

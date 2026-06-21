@extends('layouts.form-layout')

@section('title')
    تعریف ماده جدید
@endsection

@section('header')
    @include('partials.header')
@endsection

@section('h1', 'تعریف ماده جدید')

@section('h1_desc', 'توضیحات دلخواه در صورت نیاز')

@section('form')
    <form action="{{ route('materials.store') }}" method="POST"
        class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 md:p-8 ">
        @csrf

        <x-ui.form-info h2='اطلاعات پایه' h2_desc='توضیحات دلخواه در صورت نیاز' hidden='hidden'>
            <x-form.input name='name' label='نام ماده' />
            <x-form.input name='width' label='ضخامت' />
            <x-form.input name='unit' label='واحد' />
            <x-form.input name='rate' label='نرخ (ریال)' />
        </x-ui.form-info>

        <div class="flex items-center justify-end gap-3 pt-6 ">
            <x-ui.button.cancel href="{{ route('materials.index') }}"/>

            <x-ui.button.submit/>
        </div>
    </form>

    {{-- @error(any)
        {{ message }}
    @enderror --}}
@endsection

@section('script')

@endsection

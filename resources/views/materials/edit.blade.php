@extends('layouts.form-layout')

@section('title')
    ویرایش ماده
@endsection

@section('header')
    @include('partials.header')
@endsection

@section('h1', 'ویرایش ماده')

@section('h1_desc', 'توضیحات دلخواه در صورت نیاز')

@section('form')
    <form action="{{ route('materials.update', $material->id) }}" method="POST"
        class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 md:p-8 ">
        @csrf
        @method('PUT')

        <x-ui.form-info h2='اطلاعات پایه' h2_desc='توضیحات دلخواه در صورت نیاز' hidden='hidden'>
            <x-form.input name='name' label='نام ماده' :value="$material->name" />
            <x-form.input name='width' label='مشخصه فنی' :value="$material->width" />
            <x-form.input name='unit' label='واحد' :value="$material->unit" />
        </x-ui.form-info>

        <div class="flex items-center justify-end gap-3 pt-6 ">
            <x-ui.button.cancel href="{{ route('materials.index') }}"/>

            <x-ui.button.submit/>
        </div>
    </form>
@endsection

@section('script')

@endsection

@extends('layouts.form-layout')

@section('title')
    تعیین نرخ ماده
@endsection

@section('header')
    @include('partials.header')
@endsection

@section('h1', 'تعیین نرخ ماده')

@section('h1_desc', 'توضیحات دلخواه در صورت نیاز')

@section('form')
    <form action="{{ route('material-rates.store') }}" method="POST"
        class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 md:p-8 ">
        @csrf

        <x-ui.form-info h2='اطلاعات پایه' h2_desc='ابتدا ماده را انتخاب و سپس نرخ مورد نظر خود را وارد کنید.'>
            <x-form.combobox name='material_id' label='نام ماده' :options='$materials' />
            <x-form.input name='rate_per_unit' label='نرخ واحد (ریال)' />
        </x-ui.form-info>

        <div class="flex items-center justify-end gap-3 pt-6 ">
            <x-ui.button.cancel href="{{ route('materials.index') }}" />

            <x-ui.button.submit />
        </div>
    </form>
@endsection

@section('script')

@endsection

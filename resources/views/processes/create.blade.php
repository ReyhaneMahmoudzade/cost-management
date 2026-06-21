@extends('layouts.form-layout')

@section('title')
    تعریف فرآیند جدید
@endsection

@section('header')
    @include('partials.header')
@endsection

@section('h1', 'تعریف فرآیند جدید')

@section('h1_desc', 'توضیحات دلخواه در صورت نیاز')

@section('form')
    <form action="{{ route('processes.index') }}" method="POST"
        class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 md:p-8 ">
        @csrf

        <x-ui.form-info h2='اطلاعات پایه' h2_desc='توضیحات دلخواه در صورت نیاز' hidden='hidden'> 
            <x-form.input name='name' label='نام فرآیند' />
            <x-form.input name='standard_unit' label='واحد استاندارد' />
        </x-ui.form-info>

        <x-ui.form-info h2='عوامل موثر' add='add-factor' wrapper='factors-wrapper'
            h2_desc='تمامی عوامل موثر در این فرآیند را انتخاب کرده و میزان اهمیت هر عامل را 
            به صورت عددی بین 0 و 1 مشخص کنید توجه داشته باشید که مجموع وزن ها باید برابر 1 شود.'
            >
            <x-form.combobox name='factors[0][factor_id]' label='نام عامل' :options='$factors' />
            <x-form.input name='factors[0][weight]' label='وزن / اهمیت' />
        </x-ui.form-info>
        <template class="lg:col-span-2" id="factor-template">
            <div class="js-dynamic-row">
                <button type="button" class="js-dynamic-remove text-red-600 text-xs">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class=" grid grid-cols-1 md:grid-cols-2 gap-4 pb-2 border-b border-gray-200">
                    <x-form.combobox name='factors[__INDEX__][factor_id]' label='نام عامل' :options='$factors' />
                    <x-form.input name='factors[__INDEX__][weight]' label='وزن / اهمیت' />
                </div>
            </div>
        </template>

        <div class="flex items-center justify-end gap-3 pt-6 ">
            <x-ui.button.cancel href="{{ route('processes.index') }}" />

            <x-ui.button.submit />
        </div>
    </form>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new DynamicFields({
                wrapper: '#factors-wrapper',
                addButton: '#add-factor',
                template: '#factor-template',
                startIndex: 1,
            });
        });
    </script>
@endsection

@php
    $group = [
        'محفظه و متعلقات' => 'محفظه و متعلقات',
        'مواد خام' => 'مواد خام',
        'قطعات مکانیزم LBS' => 'قطعات مکانیزم LBS',
        'قطعات و مجموعه های مکانیزم VCB' => 'قطعات و مجموعه های مکانیزم VCB',
        'قطعات پلاستیکی تزریقی المنت و خازن' => 'قطعات پلاستیکی تزریقی المنت و خازن',
        'اجزا و قطعات کلیدهای خلا' => 'اجزا و قطعات کلیدهای خلا',
        'تجهیزات و قطعات تابلویی' => 'تجهیزات و قطعات تابلویی',
        'یراق آلات تابلویی' => 'یراق آلات تابلویی',
        'ترمینال المنت و خازن و اجزا' => 'ترمینال المنت و خازن و اجزا',
        'پیچ و میخ' => 'پیچ و میخ',
        'مهره و واشر' => 'مهره و واشر',
        'اجزا و قطعات سکسیونر های قابل قطع زیر بار' => 'اجزا و قطعات سکسیونر های قابل قطع زیر بار',
        'انواع مکانیزم VCB' => 'انواع مکانیزم VCB',
        'قطعات واسطه ای مکانیکی' => 'قطعات واسطه ای مکانیکی',
        'تجهیزات جانبی الحاقی تابلوهای کامپکت' => 'تجهیزات جانبی الحاقی تابلوهای کامپکت',
        'زیر مجموعه های مونتاژی LBS' => 'زیر مجموعه های مونتاژی LBS',
        'زیر مجموعه های مونتاژی لوازم جانبی' => 'زیر مجموعه های مونتاژی لوازم جانبی',
        'انواع مکانیزم LBS' => 'انواع مکانیزم LBS',
        'زیر مجموعه ها و مجموعه های مکانیزم LBS' => 'زیر مجموعه ها و مجموعه های مکانیزم LBS',
        'لوازم جانبی کلید های خلا' => 'لوازم جانبی کلید های خلا',
        'زیر مجموعه های مونتاژی VCB' => 'زیر مجموعه های مونتاژی VCB',
    ];
@endphp

@extends('layouts.form-layout')

@section('title')
    ویرایش قطعه
@endsection

@section('header')
    @include('partials.header')
@endsection

@section('h1', 'ویرایش قطعه')

@section('h1_desc', 'توضیحات دلخواه در صورت نیاز')

@section('form')
    <form action="{{ route('parts.update', $part->id) }}" method="POST"
        class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 ">
        @csrf
        @method('PUT')

        <x-ui.form-info h2='اطلاعات پایه' h2_desc='توضیحات دلخواه در صورت نیاز' hidden='hidden'>
            <x-form.input name='name' label='نام قطعه' :value="$part->name" />
            <x-form.input name='code' label='کد قطعه' :value="$part->code" />
            <x-form.combobox name='group' label='گروه کالا' :options="$group" :selected="$part->group" />
            <x-form.input name='type' label='ماهیت' :value="$part->type" />
            <x-form.input name='weight' label='وزن (گرم)' :value="$part->weight" />
            <x-form.input name='area' label=' مساحت (میلی‌متر مربع)' :value="$part->area" />
            <x-form.input name='perimeter' label='محیط (میلی‌متر)' :value="$part->perimeter" />
            <x-form.input name='description' label='سایر اطلاعات' :value="$part->description" />
        </x-ui.form-info>

        <x-ui.form-info h2='مواد سازنده' h2_desc='توضیحات دلخواه در صورت نیاز' add='add-material'
            wrapper='materials-wrapper'>
            @if ($part->partMaterials->count())
                @foreach ($part->partMaterials as $index => $partMaterial)
                    <x-form.combobox name="materials[{{ $index }}][material_id]" label='انتخاب ماده' :options='$materials' :selected="$partMaterial->material_id" />
                    <x-form.input name="materials[{{ $index }}][quantity]" label='ضریب مصرف' :value="$partMaterial->quantity" />
                @endforeach
            @else
                <x-form.combobox name='materials[0][material_id]' label='انتخاب ماده' :options='$materials' />
                <x-form.input name='materials[0][quantity]' label='ضریب مصرف' />
            @endif
        </x-ui.form-info>
        <template class="lg:col-span-2" id="material-template">
            <div class="js-dynamic-row">
                <button type="button" class="js-dynamic-remove text-red-600 text-xs">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class=" grid grid-cols-1 md:grid-cols-2 gap-4 pb-2 border-b border-gray-200">
                    <x-form.combobox name='materials[__INDEX__][material_id]' label='انتخاب ماده' :options='$materials' />
                    <x-form.input name='materials[__INDEX__][quantity]' label='ضریب مصرف' />
                </div>
            </div>
        </template>

        <x-ui.form-info h2='فرآیند ها' h2_desc='مقدار استاندارد انجام فرآیند مثلا 2 ساعت جوشکاری' add='add-process' wrapper='processes-wrapper'>
            @if ($part->partProcesses->count())
                @foreach ($part->partProcesses as $index => $partProcess)
                    <x-form.combobox name="processes[{{ $index }}][process_id]" label='انتخاب فرآیند' :options='$processes' :selected="$partProcess->process_id" />
                    <x-form.input name="processes[{{ $index }}][standard_quantity]" label='مقدار استاندارد ' :value="$partProcess->standard_quantity" />
                @endforeach
            @else
                <x-form.combobox name='processes[0][process_id]' label='انتخاب فرآیند' :options='$processes' />
                <x-form.input name='processes[0][standard_quantity]' label='مقدار استاندارد ' />
            @endif
        </x-ui.form-info>
        <template class="lg:col-span-2" id="process-template">
            <div class="js-dynamic-row">
                <button type="button" class="js-dynamic-remove text-red-600 text-xs">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class=" grid grid-cols-1 md:grid-cols-2 gap-4 pb-2 border-b border-gray-200">
                    <x-form.combobox name='processes[__INDEX__][process_id]' label='انتخاب فرآیند' :options='$processes' />
                    <x-form.input name='processes[__INDEX__][standard_quantity]'
                        label='مقدار استاندارد ' />
                </div>
            </div>
        </template>
        <div class="flex items-center justify-end gap-3 pt-6 ">
            <x-ui.button.cancel href="{{ route('parts.index') }}" />

            <x-ui.button.submit />
        </div>
    </form>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc mr-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

@section('script')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new DynamicFields({
                wrapper: '#materials-wrapper',
                addButton: '#add-material',
                template: '#material-template',
                startIndex: {{ max(count($part->partMaterials), 1) }},
            });

            new DynamicFields({
                wrapper: '#processes-wrapper',
                addButton: '#add-process',
                template: '#process-template',
                startIndex: {{ max(count($part->partProcesses), 1) }},
            });
        });
    </script>


@endsection

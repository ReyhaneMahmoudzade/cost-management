@extends('layouts.form-layout')

@section('title')
    آپلود گروهی قطعات
@endsection

@section('header')
    @include('partials.header')
@endsection

@section('h1', 'آپلود گروهی قطعات با اکسل')

@section('h1_desc', 'فقط اطلاعات پایه وارد می‌شود؛ مواد اولیه و فرآیندها را بعداً از ویرایش هر قطعه تکمیل کنید.')

@section('form')
    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4">
            <ul class="list-disc mr-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-6">
        <h2 class="font-bold text-gray-800 mb-2">۱. قالب نمونه را دانلود کنید</h2>
        <p class="text-sm text-gray-500 mb-4">
            ستون‌های «نام قطعه» و «کد قطعه» اجباری هستند. کد تکراری <b>رد می‌شود</b> (نه به‌روزرسانی).
            ردیف اول فایل (هدر) نادیده گرفته می‌شود.
        </p>
        <a href="{{ route('parts.importTemplate') }}"
            class="inline-block px-4 py-2 rounded-xl border border-emerald-600 text-emerald-700 text-sm hover:bg-emerald-50 transition">
            دانلود قالب اکسل
        </a>

        <div class="mt-4 text-xs text-gray-500 leading-6">
            <div>ستون‌ها به ترتیب: نام قطعه * | کد قطعه * | گروه کالا | ماهیت | وزن (گرم) | مساحت | محیط | سایر اطلاعات</div>
            <div>اعداد فارسی هم پذیرفته می‌شوند. حجم مجاز: حداکثر ۱۰ مگابایت (xlsx ،xls ،csv).</div>
        </div>
    </div>

    <form action="{{ route('parts.importStore') }}" method="POST" enctype="multipart/form-data"
        class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
        @csrf

        <h2 class="font-bold text-gray-800 mb-2">۲. فایل را آپلود کنید</h2>

        <input type="file" name="file" accept=".xlsx,.xls,.csv" required
            class="block w-full text-sm border border-gray-200 rounded-xl p-3 mb-4" />

        <div class="flex items-center justify-end gap-3 pt-2">
            <x-ui.button.cancel href="{{ route('parts.index') }}" />
            <x-ui.button.submit />
        </div>
    </form>

    @if (session('import_skipped') && count(session('import_skipped')))
        <div class="bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3 rounded-xl mt-6">
            <div class="font-bold mb-2">ردیف‌های تکراری رد شده ({{ count(session('import_skipped')) }}):</div>
            <ul class="list-disc mr-5 text-sm">
                @foreach (session('import_skipped') as $skip)
                    <li>ردیف {{ $skip['row'] }} — کد {{ $skip['code'] }} قبلاً در سیستم بود.</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('import_errors') && count(session('import_errors')))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mt-6">
            <div class="font-bold mb-2">ردیف‌های دارای خطا ({{ count(session('import_errors')) }}):</div>
            <ul class="list-disc mr-5 text-sm">
                @foreach (session('import_errors') as $err)
                    <li>
                        ردیف {{ $err['row'] }}:
                        {{ implode(' ', $err['messages']) }}
                    </li>
                @endforeach
            </ul>
            <div class="text-xs mt-2">این ردیف‌ها ثبت نشدند؛ اصلاح کنید و دوباره فقط همان‌ها را آپلود کنید.</div>
        </div>
    @endif

    @if (session('import_created'))
        <div class="mt-6">
            <a href="{{ route('parts.index') }}"
                class="inline-block px-4 py-2 rounded-xl bg-orange-600 text-white text-sm hover:bg-orange-500 transition">
                بازگشت به لیست قطعات برای تکمیل مواد و فرآیندها
            </a>
        </div>
    @endif
@endsection

@section('script')
@endsection

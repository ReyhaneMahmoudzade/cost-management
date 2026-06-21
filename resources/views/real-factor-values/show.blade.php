@extends('layouts.table-layout')

@section('title')
    محاسبات نهایی
@endsection

@section('header')
    @include('partials.header')
@endsection

@section('h1', 'محاسبات نهایی ')

@section('table')

    



    {{-- خلاصه --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
        <div class="grid md:grid-cols-4 gap-6">
            <div>
                <p class="text-sm text-gray-500"> نام قطعه</p>

                <p class="text-xl text-slate-800 mt-1">
                    {{ $part->code }} - {{ $part->name }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500"> هزینه مواد</p>

                <p class="text-xl text-slate-800 mt-1">
                    {{ number_format($result['materialCost']) }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500"> هزینه فرآیندها</p>

                <p class="text-xl text-slate-800 mt-1">
                    {{ number_format($result['processCost']) }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500"> قیمت تمام شده</p>

                <p class="text-xl font-bold text-orange-600 mt-1">
                    {{ number_format($result['totalCost']) }}
                </p>
            </div>
        </div>
    </div>

    {{-- مواد اولیه --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden mb-8">
        <div class="bg-gray-300 px-5 py-3">
            <h2 class=" "> مواد اولیه</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-4 text-right"> ماده</th>
                        <th class="p-4 text-right"> مقدار</th>
                        <th class="p-4 text-right"> قیمت واحد</th>
                        <th class="p-4 text-right"> هزینه</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($result['materials'] as $material)
                        <tr class="border-t">
                            <td class="p-4">{{ $material['name'] }}</td>
                            <td class="p-4"> {{ $material['quantity'] }}</td>
                            <td class="p-4">{{ number_format($material['unit_price']) }}</td>
                            <td class="p-4 "> {{ number_format($material['cost']) }}</td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr class="border-t bg-gray-50 ">
                        <td colspan="3" class="p-4"> جمع مواد</td>
                        <td class="p-4 ">{{ number_format($result['materialCost']) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>


    {{-- فرآیندها --}}
    <h2 class="text-xl  text-slate-800 mb-4"> فرآیندها</h2>

    @foreach ($result['processes'] as $process)
        <div class="bg-white rounded-xl border border-gray-200 mb-6">

            <div class="flex items-center justify-between px-5 py-4 border-b">
                <h3 class=" text-slate-800">{{ $process['name'] }}</h3>

                <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-lg text-sm font-semibold">
                    ضریب {{ number_format($process['coefficient'], 3) }}
                </span>
            </div>

            <div class="grid md:grid-cols-3 gap-6 p-5">
                <div>
                    <p class="text-sm text-gray-500"> مقدار </p>
                    <p class="font-semibold text-lg">{{ $process['quantity'] }} </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500"> نرخ </p>
                    <p class="font-semibold text-lg"> {{ number_format($process['rate']) }} </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500"> هزینه پایه</p>
                    <p class="font-semibold text-lg">{{ number_format($process['base_cost']) }}</p>
                </div>
            </div>

            {{-- عوامل --}}
            <div class="px-5 pb-5">
                <h4 class="font-semibold mb-3 text-slate-700"> عوامل موثر</h4>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-3 text-right"> عامل</th>
                                <th class="p-3 text-right"> وزن </th>
                                <th class="p-3 text-right"> مقدار واقعی</th>
                                <th class="p-3 text-right"> حاصل ضرب</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($process['factors'] as $factor)
                                <tr class="border-t">
                                    <td class="p-3">{{ $factor['factor'] }}</td>
                                    <td class="p-3">{{ $factor['weight'] }}</td>
                                    <td class="p-3">{{ $factor['value'] }}</td>
                                    <td class="p-3  font-medium">{{ number_format($factor['result'], 3) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{--  هزینه نهایی فرآیند --}}
            <div class="flex justify-between items-center border-t px-5 py-4 bg-gray-50">
                <span class="text-slate-700"> هزینه نهایی فرآیند</span>
                <span class=" text-xl text-orange-600"> {{ number_format($process['final_cost']) }}</span>
            </div>
        </div>
    @endforeach
    
@endsection

@section('script')
@endsection
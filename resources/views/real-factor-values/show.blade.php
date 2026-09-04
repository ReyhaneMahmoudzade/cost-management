




@extends('layouts.table-layout')

@section('title', 'محاسبات نهایی')

@section('header')
    @include('partials.header')
@endsection

@section('h1', 'محاسبات نهایی')

@section('table')

    {{-- Summary Section --}}
    <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-4 mb-8">
        @php
            $cards = [
                ['label' => 'نام قطعه', 'value' => $part->code . ' - ' . $part->name, 'color' => 'blue'],
                ['label' => 'هزینه مواد', 'value' => number_format($result['materialCost']), 'color' => 'gray'],
                ['label' => 'هزینه فرآیندها', 'value' => number_format($result['processCost']), 'color' => 'amber'],
                ['label' => 'قیمت تمام شده', 'value' => number_format($result['totalCost']), 'color' => 'emerald'],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 hover:shadow-md transition-shadow">
                <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">{{ $card['label'] }}</p>
                <p class="text-lg font-bold text-gray-800 mt-2 font-mono {{ $card['color'] === 'emerald' ? 'text-emerald-600' : '' }}">
                    {{ $card['value'] }}
                </p>
            </div>
        @endforeach
    </div>

    {{-- Materials Section --}}
    <section class="mb-10">
        <h2 class="text-lg font-bold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fas fa-cubes text-blue-500"></i> مواد اولیه
        </h2>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
            <table class="w-full text-sm text-right">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">ماده</th>
                        <th class="px-6 py-4">ضریب مصرف</th>
                        <th class="px-6 py-4">قیمت واحد</th>
                        <th class="px-6 py-4">هزینه</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($result['materials'] as $material)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $material['name'] }}</td>
                            <td class="px-6 py-4 text-gray-600 font-mono">{{ $material['quantity'] }}</td>
                            <td class="px-6 py-4 text-gray-600 font-mono">{{ number_format($material['unit_price']) }}</td>
                            <td class="px-6 py-4 font-bold text-gray-900 font-mono">{{ number_format($material['cost']) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-blue-50/50">
                    <tr>
                        <td colspan="3" class="px-6 py-4 font-bold text-blue-900">جمع کل مواد</td>
                        <td class="px-6 py-4 font-bold text-blue-700 font-mono">{{ number_format($result['materialCost']) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </section>

    {{-- Processes Section --}}
    @foreach ($result['processes'] as $process)
        <section class="mb-8 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mt-6">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                <h2 class="font-bold text-gray-700 flex items-center gap-2">
                    <i class="fas fa-cogs text-amber-500"></i> فرآیند: {{ $process['name'] }}
                </h2>
                <span class="text-sm font-medium text-amber-700 bg-amber-100 px-3 py-1 rounded-full">
                    هزینه نهایی: {{ number_format($process['final_cost']) }}
                </span>
            </div>
            
            <div class="p-6">
                <h4 class="font-semibold mb-4 text-gray-600 text-sm uppercase">عوامل موثر</h4>
                <div class="overflow-x-auto mb-6">
                    <table class="w-full text-sm">
                        <thead class="text-gray-500 border-b">
                            <tr>
                                <th class="py-2 text-right">عامل</th>
                                <th class="py-2 text-right">وزن</th>
                                <th class="py-2 text-right">مقدار واقعی</th>
                                <th class="py-2 text-right">حاصل ضرب</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($process['factors'] as $factor)
                                <tr>
                                    <td class="py-3">{{ $factor['factor'] }}</td>
                                    <td class="py-3 font-mono">{{ $factor['weight'] }}</td>
                                    <td class="py-3 font-mono">{{ $factor['value'] }}</td>
                                    <td class="py-3 font-mono font-medium">{{ number_format($factor['result'], 3) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4 border-t border-gray-100">
                    @foreach (['مقدار' => 'quantity', 'نرخ' => 'rate', 'هزینه پایه' => 'base_cost', 'ضریب نهایی' => 'coefficient'] as $label => $key)
                        <div>
                            <p class="text-xs text-gray-400">{{ $label }}</p>
                            <p class="font-semibold text-gray-800 font-mono">
                                {{ is_numeric($process[$key]) ? number_format($process[$key], ($key == 'coefficient' ? 3 : 0)) : $process[$key] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach

@endsection


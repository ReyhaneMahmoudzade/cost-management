@extends('layouts.table-layout')

@section('title')
    محاسبات نهایی
@endsection

@section('header')
    @include('partials.header')
@endsection

@section('h1', 'محاسبات نهایی')

@section('add_btn')
    <x-ui.button.add-btn href="{{ route('real-factor-values.create') }}" />
@endsection

@section('table')

    {{-- @foreach ($parts as $part)
        <h1 class="text-red-900 text-lg">قطعه: {{ $part->name }}</h3>

            <h4>مواد</h4>
            <ul>
                @foreach ($part->partMaterials as $partMaterial)
                    <li>
                        {{ $partMaterial->material->name }}
                        {{ $partMaterial->quantity ?? '------' }}
                        {{ $partMaterial->material->rate }}
                    </li>
                @endforeach
            </ul>

            <h4>فرایندها</h4>
            <ul>
                @foreach ($part->partProcesses as $partProcess)
                    <li>
                        فرایند: {{ $partProcess->process->name }}
                        @foreach ($partProcess->process->processRates as $rate)
                            {{ $rate->rate_per_unit ?? '-------' }}
                        @endforeach

                        <ul>
                            @foreach ($partProcess->process->processFactors as $processFactor)
                                <li>
                                    عامل موثر: {{ $processFactor->factor->name }}
                                </li>
                            @endforeach
                        </ul>

                    </li>
                @endforeach
            </ul>
    @endforeach --}}

    @include('partials.table', [
        'columns' => $columns,
        'rows' => $rows,
        'actions' => $actions,
        'routes' => $routes,
    ])

@endsection

@section('script')

@endsection

@extends('layouts.form-layout')

@section('title')
    اختصاص ضرایب واقعی
@endsection

@section('header')
    @include('partials.header')
@endsection

@section('h1', 'اختصاص ضرایب واقعی')

@section('h1_desc', 'توضیحات دلخواه در صورت نیاز')

@section('form')
    <form action="{{ route('real-factor-values.store') }}" method="POST"
        class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 md:p-8 ">
        @csrf

        <x-ui.form-info h2='انتخاب قطعه' h2_desc='توضیحات دلخواه در صورت نیاز' hidden='hidden'>
            <x-form.combobox2 name='part_id' label='انتخاب قطعه' :options="$parts" textField="code" textField2="name" />

        </x-ui.form-info>

        <div id="processes-container"></div>

        <div class="flex items-center justify-end gap-3 pt-6 ">
            <x-ui.button.cancel href="{{ route('real-factor-values.index') }}" />

            <x-ui.button.submit />
        </div>
    </form>
@endsection

@section('script')
    <script>
        document.querySelector('[name = part_id]')
            .addEventListener('change', async function() {

                const partId = this.value;

                if (!partId) {
                    document.getElementById('processes-container').innerHTML = '';
                    return;
                }

                const response = await fetch(
                    `/parts/${partId}/processes`
                );

                const processes = await response.json();

                let html = '';

                processes.forEach(partProcess => {

                    html += `
                        <x-ui.form-info h2='فرآیند ${partProcess.process.name}' h2_desc='توضیحات دلخواه در صورت نیاز' hidden='hidden'>

                    `;

                    partProcess.process.process_factors.forEach(processFactor => {

                        html += `

                        <x-form.input name='coefficients[${partProcess.id}][${processFactor.id}]' label='${processFactor.factor.name}' />                                        

                        `;
                    });

                    html += `</x-ui.form-info>`;
                });

                document.getElementById('processes-container').innerHTML = html;
            });
    </script>
@endsection

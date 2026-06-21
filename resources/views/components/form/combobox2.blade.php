@props([
    'label' => '',
    'name',
    'options' => [],
    'valueField' => 'id',
    'textField' => 'name',
    'textField2' => '',
    'placeholder' => '',
    'selected' => null,
])

@php
    $dotName = str_replace(['[', ']'], ['.', ''], $name);
    $selectedValue = old($dotName, $selected);
    $selectedText = '';

    foreach ($options as $key => $option) {
        $optionValue = is_object($option) || is_array($option)
            ? data_get($option, $valueField)
            : $key;

        $optionText = is_object($option) || is_array($option)
            ? data_get($option, $textField)
            : $option;

        $optionText2 = is_object($option) || is_array($option)
            ? data_get($option, $textField2)
            : $option;

        if ((string) $optionValue === (string) $selectedValue) {
            $selectedText = $optionText;
            break;
        }
    }
@endphp

<div class=" js-combo-wrapper text-right">
    @if($label)
        <label class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
        </label>
    @endif

    <div
        class="relative"
        data-hs-combo-box='{
            "isOpenOnFocus": true,
            "preventVisibility": false
        }'
    >
        <div class="relative">
            <input
                type="text"
                value="{{ $selectedText }}"
                placeholder="{{ $placeholder }}"
                autocomplete="off"
                role="combobox"
                aria-expanded="false"
                class="py-3 ps-4 pe-10 block w-full bg-white border rounded-xl shadow-sm text-sm text-gray-700 placeholder:text-gray-400 outline-none transition-all duration-300
                {{ $errors->has($dotName)
                    ? 'border-red-500 focus:border-red-500 focus:ring-4 focus:ring-red-100'
                    : 'border-gray-300 focus:border-slate-600 focus:ring-4 focus:ring-slate-100'
                }}"
                data-hs-combo-box-input
            >

            <div
                class="absolute top-1/2 end-3 -translate-y-1/2"
                aria-expanded="false"
                role="button"
                data-hs-combo-box-toggle
            >
                <svg
                    class="shrink-0 size-4 text-gray-400"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path d="m7 15 5 5 5-5"></path>
                    <path d="m7 9 5-5 5 5"></path>
                </svg>
            </div>
        </div>

        <div
            class="absolute z-50 w-full max-h-72 bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden overflow-y-auto hidden"
            role="listbox"
            tabindex="-1"
            aria-orientation="vertical"
            data-hs-combo-box-output
        >
            @foreach($options as $key => $option)
                @php
                    $optionValue = is_object($option) || is_array($option)
                        ? data_get($option, $valueField)
                        : $key;

                    $optionText = is_object($option) || is_array($option)
                        ? data_get($option, $textField)
                        : $option;

                    $optionText2 = is_object($option) || is_array($option)
                        ? data_get($option, $textField2)
                        : $option;

                    $isSelected = (string) $optionValue === (string) $selectedValue;
                @endphp

                <div
                    class="cursor-pointer py-2 px-4 w-full text-sm text-gray-700 hover:bg-gray-100 rounded-lg focus:outline-none {{ $isSelected ? 'selected' : '' }}"
                    role="option"
                    tabindex="0"
                    data-hs-combo-box-output-item
                    data-hs-combo-box-item-stored-data='@json([$valueField => $optionValue, $textField => $optionText], JSON_UNESCAPED_UNICODE)'
                >
                    <div class="flex justify-between items-center w-full">
                        <span
                            data-hs-combo-box-search-text="{{ $optionText }} - {{ $optionText2 }}"
                            data-hs-combo-box-value
                            data-id="{{ $optionValue }}"
                        >
                            {{ $optionText }} - {{ $optionText2 }}
                        </span>

                        <span class="hidden hs-combo-box-selected:block">
                            <svg
                                class="shrink-0 size-4 text-slate-600"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path d="M20 6 9 17l-5-5"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <input
        type="hidden"
        name="{{ $name }}"
        value="{{ $selectedValue }}"
        class="js-combo-hidden-input"
    >

    @error($dotName)
        <p class="text-red-500 text-xs mt-1">
            {{ $message }}
        </p>
    @enderror
</div>











{{-- @props([
    'label' => '',
    'name',
    'options' => [],
    'valueField' => 'id',
    'textField' => 'name',
])

<div class="flex flex-col mb-4">
    <div class="flex w-full items-end gap-2 justify-start">

        @if ($label)
            <label class="w-[120px] block mb-2 text-slate-600 text-sm font-medium">
                {{ $label }}
            </label>
        @endif

        <div class="combo-wrapper js-combo-wrapper w-1/2">

            <div class="relative w-full"
                 data-hs-combo-box='{
                    "isOpenOnFocus": true,
                    "preventVisibility": false
                 }'>

                <div class="relative">
                    <input
                        type="text"
                        class="form-input px-4 py-2 rounded-md border bg-slate-100 focus:outline-none focus:ring-2 w-full
                        {{ $errors->has(str_replace(['[', ']'], ['.', ''], $name))
                            ? 'border-red-500 focus:ring-red-500'
                            : 'border-gray-300 focus:ring-teal-800' }}"
                        placeholder="جستجو کنید..."
                        data-hs-combo-box-input
                    >

                    <div
                        class="absolute top-1/2 end-3 -translate-y-1/2 cursor-pointer"
                        data-hs-combo-box-toggle
                    >
                        <svg class="shrink-0 size-4 text-gray-500"
                             xmlns="http://www.w3.org/2000/svg"
                             width="24"
                             height="24"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">
                            <path d="m7 15 5 5 5-5"/>
                            <path d="m7 9 5-5 5 5"/>
                        </svg>
                    </div>
                </div>

                <div
                    class="absolute z-50 w-full max-h-72 p-1 bg-white border border-gray-200 rounded-lg shadow-lg mt-1 overflow-y-auto hidden"
                    data-hs-combo-box-output
                >
                    <div data-hs-combo-box-output-items-wrapper>

                        @foreach ($options as $key => $option)

                            @php
                                $optionValue =
                                    is_object($option) || is_array($option)
                                        ? data_get($option, $valueField)
                                        : $key;

                                $optionText =
                                    is_object($option) || is_array($option)
                                        ? data_get($option, $textField)
                                        : $option;
                            @endphp

                            <div
                                class="cursor-pointer py-2 px-4 w-full text-sm text-gray-800 hover:bg-gray-100 rounded-lg"
                                data-hs-combo-box-output-item >
                                <div class="flex justify-between items-center w-full">

                                    <span
                                        data-hs-combo-box-value
                                        data-id="{{ $optionValue }}"
                                        data-hs-combo-box-search-text="{{ $optionText }}">
                                        {{ $optionText }}
                                    </span>

                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>

            </div>

            <input
                type="hidden"
                name="{{ $name }}"
                class="js-combo-hidden-input"
            >

        </div>

    </div>

    <div class="flex w-full items-end gap-2 justify-start">
        <label class="w-[120px] block mb-2"></label>

        @php
            $dotName = str_replace(['[', ']'], ['.', ''], $name);
        @endphp

        @error($dotName)
        <p class="text-red-500 text-xs mt-1 error-message">
            {{ $message }}
        </p>
        @enderror
    </div>
</div> --}}

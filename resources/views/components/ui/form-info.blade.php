@props([
    'h2' => 'مقدار پیشفرضضض',
    'h2_desc' => 'مقدار پیشفرضضض',
    'add' => '',
    'hidden' => '',
    'wrapper' => '',
])


<div class="border-b border-gray-200">
    <div class="mb-12 grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-10 mt-4">

        <div class="lg:col-span-1">
            <div class="sticky top-6">
                <div class="flex items-center mb-2 gap-2">
                    <h2 class="text-lg font-semibold text-gray-800 ">{{ $h2 }}</h2>
                    <button type="button" id="{{ $add }}" class="{{ $hidden }}">
                        <i class="fa-solid fa-plus text-slate-500"></i>
                    </button>
                </div>
                <p class="text-sm text-gray-500 leading-7">
                    {{ $h2_desc }}
                </p>
            </div>
        </div>

        <div class="lg:col-span-2" id="{{ $wrapper }}">
            <div class="js-dynamic-row grid grid-cols-1 md:grid-cols-2 gap-4 pb-2 border-b border-gray-200">
                {{ $slot }}
            </div>
        </div>

    </div>
</div>

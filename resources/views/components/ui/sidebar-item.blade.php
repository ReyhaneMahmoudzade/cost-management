@props([
    'href' => '#',
    'active' => '',
    'itemName' => '',
])


<a href="{{ $href }}"
    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-700
            {{ $active }} transition">
             {{ $slot }}
    {{ $itemName }}
</a>

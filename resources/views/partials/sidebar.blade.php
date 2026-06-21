<aside class="w-64 bg-slate-800 text-white flex flex-col">

    <!-- Logo -->
    <div class="h-20 flex items-center justify-center border-b border-slate-600">
        <h1 class="text-2xl font-bold">
            {{-- پالایش نیرو --}}
            شرکت تست
        </h1>
    </div>

    <!-- Menu -->
    <nav class="flex-1 p-4 space-y-2 overflow-y-auto">

        {{-- <a href="{{ route('home') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-700 
            {{ request()->routeIs('home') ? 'bg-slate-700' : '' }} transition">
            صفحه اصلی
        </a> --}}
        {{-- <x-ui.sidebar-item href="{{ route('home') }}"
            active="{{ request()->routeIs('home') ? 'bg-slate-700' : '' }}" itemName="صفحه اصلی">
            <i class="fa-solid fa-home"></i>
            {{-- <i class="fa-solid fa-calculator"></i>
            <i class="fa-solid fa-sliders"></i>
            <i class="fa-solid fa-bullseye"></i> --}}
        {{-- </x-ui.sidebar-item>  --}}

        {{-- <a href="{{ route('materials.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-700
            {{ request()->routeIs('materials.*') ? 'bg-slate-700' : '' }} transition">
            مواد اولیه
        </a> --}}
        <x-ui.sidebar-item href="{{ route('parts.index') }}"
            active="{{ request()->routeIs('parts.*') ? 'bg-slate-700' : '' }}" itemName="قطعات">
            <i class="fas fa-microchip"></i>
        </x-ui.sidebar-item>
        
        <x-ui.sidebar-item href="{{ route('materials.index') }}"
            active="{{ request()->routeIs('materials.*') ? 'bg-slate-700' : '' }}" itemName="مواد اولیه">
            <i class="fas fa-cubes"></i>
        </x-ui.sidebar-item>

        {{-- <a href="{{ route('parts.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-700
            {{ request()->routeIs('parts.*') ? 'bg-slate-700' : '' }} transition">
            قطعات
        </a> --}}
        

        {{-- <a href="{{ route('processes.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-700
            {{ request()->routeIs('processes.*') ? 'bg-slate-700' : '' }} transition">
            فرآیندها
        </a> --}}
        <x-ui.sidebar-item href="{{ route('processes.index') }}"
            active="{{ request()->routeIs('processes.*') ? 'bg-slate-700' : '' }}" itemName="فرآیندها">
            <i class="fas fa-cogs"></i>
        </x-ui.sidebar-item>

        {{-- <a href="{{ route('factors.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-700
            {{ request()->routeIs('factors.*') ? 'bg-slate-700' : '' }} transition">
            عوامل موثر
        </a> --}}
        <x-ui.sidebar-item href="{{ route('factors.index') }}"
            active="{{ request()->routeIs('factors.*') ? 'bg-slate-700' : '' }}" itemName="عوامل موثر">
            <i class="fas fa-sliders"></i>
        </x-ui.sidebar-item>

        <x-ui.sidebar-item href="{{ route('real-factor-values.index') }}"
            active="{{ request()->routeIs('real-factor-values.*') ? 'bg-slate-700' : '' }}" itemName="اختصاص ضرایب واقعی">
            {{-- <i class="fas fa-square-root-variable"></i> --}}
            <i class="fas fa-clipboard-check"></i>
        </x-ui.sidebar-item>

        {{-- <x-ui.sidebar-item href="{{ route('') }}"
            active="{{ request()->routeIs('.*') ? 'bg-slate-700' : '' }}" itemName="">
            <i class=""></i>
        </x-ui.sidebar-item> --}}
    </nav>

    <!-- User -->


</aside>

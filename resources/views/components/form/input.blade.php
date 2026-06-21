@props(['name', 'label' => 'مقدار پیش فرض'])


{{-- <div class="relative dir-rtl">
    <input type="text" name={{ $name }} id="" autocomplete="off"
        class="block px-4 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-200
    appearance-none focus:outline-none focus:ring-0 focus:border-indigo-600 peer"
        placeholder=" " />
    <label for=""
        class="bg-gray-100 absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10
         origin-[top_right]
    px-2 peer-focus:px-2 peer-focus:text-indigo-600 peer-placeholder-shown:scale-100
    peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 
    peer-focus:-translate-y-4 right-3">
        {{ $label }}
    </label>
</div> --}}



<div class="text-right">
    <label for="" class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    <input 
        type="" 
        name={{ $name }} 
        placeholder=""
        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl shadow-sm outline-none transition-all duration-300
        focus:border-slate-600 focus:ring-4 focus:ring-slate-100 placeholder:text-gray-400" />
</div>

{{-- <div class="max-w-sm dir-rtl">
  <div class="relative">
    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
      <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2
         2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
      </svg>
    </div>
    <input 
      type="password" 
      placeholder="رمز عبور" 
      class="w-full pr-10 pl-4 py-3 bg-gray-50/50 backdrop-blur-md border border-gray-200 rounded-2xl focus:bg-white
       focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none transition-all"
    />
  </div>
</div> --}}

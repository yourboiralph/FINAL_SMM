<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 transition-opacity z-[999]"
>
    <div class="bg-white text-gray-800 px-6 py-4 rounded-lg shadow-lg max-w-sm w-full text-center space-y-4 flex items-center justify-center mx-auto flex-col">
        <p class="text-lg font-semibold">{{ session('Status') }}</p>
        
        <a href="{{url('/')}}"><div class="px-4 py-2 bg-[#fa7011] text-white w-fit">OK</div></a>
    </div>
</div>

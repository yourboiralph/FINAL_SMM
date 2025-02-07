@php
    $user = Auth::user();
@endphp

@props(['header' => ""])

<div class="grid grid-cols-3">
    <x-pagetitle header="{{ $header }}" />
    <div class="hidden md:block">
        <div class="bg-[#fa7011] rounded-bl-[40px] flex items-center justify-center gap-8 h-fit px-2 py-4">
            <h1 class="text-white hidden lg:block">Hi, {{ $user->name ?? 'Guest' }}</h1>
            
            {{-- Proper way to check if user has an image --}}
            <img src="{{ $user->image ? asset($user->image) : asset('/Assets/user-profile-profilepage.png') }}" 
                 class="w-14 h-14 rounded-full" 
                 alt="User Profile" 
                 draggable="false">
            
            {{-- Logout Button --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">
                    <i class="fa-solid fa-power-off text-xl bg-white px-2 py-1 rounded-lg" style="color: #fa7011;"></i>
                </button>
            </form>
        </div>
    </div>
</div>

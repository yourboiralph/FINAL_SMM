@php
    $user = Auth::user();
    $user->role
@endphp

@props(['link' => $user->role->position])

<div class="space-y-4 z-10">
    @if ($link === 'operations')

        {{-- Admin Sidebar Menu --}}
        <div class="hidden md:block md:px-6">
            <a href="{{ url("/dashboard") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("dashboard", "dashboard/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("dashboard", "dashboard/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-dashboard-white.png"
                    draggable="false"
                    class=" p-2 rounded-lg w-10 h-10 {{ request()->is("dashboard", "dashboard/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="project Icon">
                <h1 class="hidden md:block">Dashboard</h1>
            </a>
        </div>
        <div class="hidden md:block md:px-6">
            <a href="{{ url("/joborder") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("joborder", "joborder/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("joborder", "joborder/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("joborder", "ghihgjoborder/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Project Development Icon">
                <h1 class="hidden md:block">Job Order</h1>
            </a>
        </div>

        <div class="hidden md:block md:px-6">
            <a href="{{ url("/profile") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("profile", "profile/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("profile", "profile/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("profile", "profile/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <h1 class="hidden md:block">Profile</h1>
            </a>
        </div>

        <div class="hidden md:block md:px-6">
            <a href="{{ url("/revisions") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("revisions", "revisions/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("revisions", "revisions/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("revisions", "revisions/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <h1 class="hidden md:block">Revision Checklist</h1>
            </a>
        </div>
        
        <div class="hidden md:block md:px-6">
            <a href="{{ url("/promotions") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("promotions", "promotions/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("promotions", "promotions/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("promotions", "promotions/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <h1 class="hidden md:block">Promotions</h1>
            </a>
        </div>

        <div class="hidden md:block md:px-6">
            <a href="{{ url("/manual") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("manual", "manual/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("manual", "manual/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("manual", "manual/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <h1 class="hidden md:block">Instruction Manual</h1>
            </a>
        </div>

        <div class="hidden md:block md:px-6">
            <a href="{{ url("/users") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("users", "users/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("users", "users/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("users", "users/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <h1 class="hidden md:block">Add users</h1>
            </a>
        </div>

    @elseif ($link === 'client')
        {{-- Client Sidebar Menu --}}
        <div class="hidden md:block md:px-6">
            <a href="{{ url("/dashboard") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("dashboard", "/dashboard/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("dashboard", "/dashboard/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-dashboard-white.png"
                    draggable="false"
                    class=" p-2 rounded-lg w-10 h-10 {{ request()->is("dashboard", "/dashboard/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Dashboard Icon">
                <h1 class="hidden md:block">Dashboard</h1>
            </a>
        </div>

        <div class="hidden md:block md:px-6">
            <a href="{{ url("/joborder") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("joborder", "joborder/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("joborder", "joborder/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("joborder", "ghihgjoborder/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Project Development Icon">
                <h1 class="hidden md:block">Job Order</h1>
            </a>
        </div>

        <div class="hidden md:block md:px-6">
            <a href="{{ url("/profile") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("profile", "profile/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("profile", "profile/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-profile-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("profile", "profile/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <h1 class="hidden md:block">Profile</h1>
            </a>
        </div>

        <div class="hidden md:block md:px-6">
            <a href="{{ url("/promotions") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("promotions", "promotions/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("promotions", "promotions/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-profile-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("promotions", "promotions/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <h1 class="hidden md:block">Promotions</h1>
            </a>
        </div>

    @elseif ($link === 'content_writer')

        <div class="hidden md:block md:px-6">
            <a href="{{ url("/content") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("content", "content/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("content", "content/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-profile-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("content", "content/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <h1 class="hidden md:block">List of Job Orders</h1>
            </a>
        </div>
    @endif
</div>

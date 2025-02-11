@php
    $user = Auth::user();
    $user->role
@endphp

@props(['link' => $user->role->position])

<div class="space-y-4 z-10 overflow-y-auto">
    @if ($link === 'operations')

        {{-- Admin Sidebar Menu --}}
        <div class=" block px-6">
            <a href="{{ url("/dashboard") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("dashboard", "dashboard/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("dashboard", "dashboard/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-dashboard-white.png"
                    draggable="false"
                    class=" p-2 rounded-lg w-10 h-10 {{ request()->is("dashboard", "dashboard/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="project Icon">
                <h1 class=" block">Dashboard</h1>
            </a>
        </div>
        <div class=" block px-6">
            <a href="{{ url("/joborder") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("joborder", "joborder/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("joborder", "joborder/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("joborder", "ghihgjoborder/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Project Development Icon">
                <h1 class=" block">Job Order</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/operation") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("operation", "operation/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("operation", "operation/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("operation", "operation/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Project Development Icon">
                <h1 class=" block">Approval</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/revisions") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("revisions", "revisions/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("revisions", "revisions/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("revisions", "revisions/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <h1 class=" block">Revision Checklist</h1>
            </a>
        </div>
        
        <div class=" block px-6">
            <a href="{{ url("/promotions") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("promotions", "promotions/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("promotions", "promotions/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("promotions", "promotions/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <h1 class=" block">Promotions</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/manual") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("manual", "manual/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("manual", "manual/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("manual", "manual/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <h1 class=" block">Instruction Manual</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/users") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("users", "users/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("users", "users/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("users", "users/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <h1 class=" block">Add users</h1>
            </a>
        </div>

    @elseif ($link === 'client')
        {{-- Client Sidebar Menu --}}
        <div class=" block px-6">
            <a href="{{ url("/dashboard") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("dashboard", "/dashboard/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("dashboard", "/dashboard/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-dashboard-white.png"
                    draggable="false"
                    class=" p-2 rounded-lg w-10 h-10 {{ request()->is("dashboard", "/dashboard/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Dashboard Icon">
                <h1 class=" block">Dashboard</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/client") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("client", "client") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("client", "client") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("client", "client") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Project Development Icon">
                <h1 class=" block">Approvals</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/client/history") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("client/history", "client/history/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("client/history", "client/history/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-profile-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("client/history", "client/history/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <h1 class=" block">History</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/profile") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("profile", "profile/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("profile", "profile/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-profile-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("profile", "profile/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <h1 class=" block">Profile</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/promotions") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("promotions", "promotions/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("promotions", "promotions/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-profile-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("promotions", "promotions/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <h1 class=" block">Promotions</h1>
            </a>
        </div>

    @elseif ($link === 'content_writer')
        <div class=" block px-6">
            <a href="{{ url("/dashboard") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("dashboard", "dashboard/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("dashboard", "dashboard/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-dashboard-white.png"
                    draggable="false"
                    class=" p-2 rounded-lg w-10 h-10 {{ request()->is("dashboard", "dashboard/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="project Icon">
                <h1 class=" block">Dashboard</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/content") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("content", "content") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("content", "content") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-profile-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("content", "content") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <h1 class=" block">List of Job Orders</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/content/revisions") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("content/revisions", "content/revisions/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("content/revisions", "content/revisions/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("content/revisions", "content/revisions/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <h1 class=" block">Revision Checklist</h1>
            </a>
        </div>
    @elseif ($link === 'graphic_designer')
        <div class=" block px-6">
            <a href="{{ url("/dashboard") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("dashboard", "dashboard/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("dashboard", "dashboard/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-dashboard-white.png"
                    draggable="false"
                    class=" p-2 rounded-lg w-10 h-10 {{ request()->is("dashboard", "dashboard/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="project Icon">
                <h1 class=" block">Dashboard</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/graphic") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("graphic", "graphic") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("graphic", "graphic") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-profile-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("graphic", "graphic") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <h1 class=" block">List of Job Orders</h1>
            </a>
        </div>
        <div class=" block px-6">
            <a href="{{ url("/graphic/revisions") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("graphic/revisions", "graphic/revisions/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("graphic/revisions", "graphic/revisions/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("graphic/revisions", "graphic/revisions/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <h1 class=" block">Revision Checklist</h1>
            </a>
        </div>
    @elseif ($link === 'top_manager')
        {{-- Admin Sidebar Menu --}}
        <div class=" block px-6">
            <a href="{{ url("/dashboard") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("dashboard", "dashboard/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("dashboard", "dashboard/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-dashboard-white.png"
                    draggable="false"
                    class=" p-2 rounded-lg w-10 h-10 {{ request()->is("dashboard", "dashboard/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="project Icon">
                <h1 class=" block">Dashboard</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/topmanager") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("topmanager", "topmanager/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("topmanager", "topmanager/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("topmanager", "topmanager/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Project Development Icon">
                <h1 class=" block">Approval</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/profile") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("profile", "profile/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("profile", "profile/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("profile", "profile/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <h1 class=" block">Profile</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/revisions") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("revisions", "revisions/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("revisions", "revisions/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("revisions", "revisions/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <h1 class=" block">Revision Checklist</h1>
            </a>
        </div>
        
        <div class=" block px-6">
            <a href="{{ url("/promotions") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("promotions", "promotions/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("promotions", "promotions/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("promotions", "promotions/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <h1 class=" block">Promotions</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/manual") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("manual", "manual/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("manual", "manual/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("manual", "manual/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <h1 class=" block">Instruction Manual</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/users") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("users", "users/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("users", "users/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="/Assets/icon-projdev-white.png"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("users", "users/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <h1 class=" block">Add users</h1>
            </a>
        </div>
    @endif
</div>

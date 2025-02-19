@php
    $user = Auth::user();
    $user->role
@endphp

@props(['link' => $user->role->position])

<div class="space-y-4 z-10 overflow-y-auto h-full">
    @if ($link === 'operations')

        {{-- Admin Sidebar Menu --}}
        <div class=" block px-6">
            <a href="{{ url("/dashboard") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("dashboard", "dashboard/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("dashboard", "dashboard/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-dashboard-white.png')}}"
                    draggable="false"
                    class=" p-2 rounded-lg w-10 h-10 {{ request()->is("dashboard", "dashboard/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="project Icon">
                <h1 class=" block">Dashboard</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/operation/task") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("operation/task", "operation/task/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("operation/task", "operation/task/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-projdev-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("operation/task", "operation/task/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Project Development Icon">
                <div class="flex justify-between w-full">
                    <p class=" block">My Tasks</p>
                    <p class="mr-10 text-[.8rem] py-1 text-white px-2 rounded-lg bg-red-600 {{$operationTaskCount < 1 ? "hidden" : ""}}">{{ $operationTaskCount }}</p>
                </div>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/operation/requests") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("operation/requests", "operation/request/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("operation/requests", "operation/request/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-projdev-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("operation/requests", "operation/request/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Project Development Icon">
                <div class="flex justify-between w-full">
                    <p class=" block">Incoming Requests</p>
                    <p class="mr-10 text-[.8rem] py-1 text-white px-2 rounded-lg bg-red-600 {{$operationIncomingRequestCount < 1 ? "hidden" : ""}}">{{ $operationIncomingRequestCount }}</p>
                </div>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/joborder") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("joborder", "joborder/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("joborder", "joborder/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-projdev-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("joborder", "joborder/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Project Development Icon">
                <h1 class=" block">Outgoing Requests</h1>
            </a>
        </div>


        <div class=" block px-6">
            <a href="{{ url("/operation") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("operation", "operation/show/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("operation", "operation/show/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-projdev-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("operation", "operation/show/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Project Development Icon">
                <div class="flex justify-between w-full">
                    <p class=" block">Approvals</p>
                    <p class="mr-10 text-[.8rem] py-1 text-white px-2 rounded-lg bg-red-600 {{$operationApprovalCount < 1 ? "hidden" : ""}}">{{ $operationApprovalCount }}</p>
                </div>
            </a>
        </div>



        <div class=" block px-6">
            <a href="{{ url("/operation/revision") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("operation/revision", "operation/revisions", "operation/revisions/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("operation/revision", "operation/revisions", "operation/revisions/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-projdev-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("operation/revision","operation/revisions", "operation/revisions/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Project Development Icon">
                <div class="flex justify-between w-full">
                    <p class=" block">My Revisions</p>
                    <p class="mr-10 text-[.8rem] py-1 text-white px-2 rounded-lg bg-red-600 {{$operationRevisionCount < 1 ? "hidden" : ""}}">{{ $operationRevisionCount }}</p>
                </div>
            </a>
        </div>

        {{-- <div class=" block px-6">
            <a href="{{ url("/revisions") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("revisions", "revisions/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("revisions", "revisions/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
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
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
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
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("manual", "manual/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <h1 class=" block">Instruction Manual</h1>
            </a>
        </div> --}}

        <div class=" block px-6">
            <a href="{{ url("/operation/renewal") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("operation/renewal", "operation/renewal/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("operation/renewal", "operation/renewal/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("operation/renewal", "operation/renewal/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <h1 class=" block">Renewal</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/profile/show") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("profile", "profile/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("profile", "profile/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("profile", "profile/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <h1 class=" block">Profile</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/users") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("users", "register", "users/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("users", "register", "users/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("users", "register", "users/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <h1 class=" block">Add users</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/operation/history") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("operation/history", "operation/history/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("operation/history", "operation/history/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("operation/history", "operation/history/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <h1 class=" block">Downloadables</h1>
            </a>
        </div>

        <div class=" block lg:hidden px-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="p-2 flex items-center w-full gap-2 rounded-md bg-red-500 text-white font-bold hover:bg-red-600 transition duration-300">
                    <i class="fa-solid fa-power-off"></i>
                    <h1 class="block">Logout</h1>
                </button>
            </form>
        </div>

    @elseif ($link === 'client')
        {{-- Client Sidebar Menu --}}
        <div class=" block px-6">
            <a href="{{ url("/dashboard") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("dashboard", "/dashboard/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("dashboard", "/dashboard/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class=" p-2 rounded-lg w-10 h-10 {{ request()->is("dashboard", "/dashboard/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Dashboard Icon">
                <h1 class=" block">Dashboard</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/client") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("client", "client/show/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("client", "client/show/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("client", "client/show/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Project Development Icon">
                <div class="flex justify-between w-full">
                    <p class=" block">Approvals</p>
                    <p class="mr-10 text-[.8rem] py-1 text-white px-2 rounded-lg bg-red-600 {{$clientDraftCount < 1 ? "hidden" : ""}}">{{ $clientDraftCount }}</p>
                </div>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/client/history") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("client/history", "client/history/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("client/history", "client/history/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("client/history", "client/history/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <div class="flex justify-between w-full">
                    <p class=" block">Downloadables</p>
                    {{-- <p class="mr-10 text-[.8rem] py-1 text-white px-2 rounded-lg bg-red-600">{{ $clientCompletedCount }}</p> --}}
                </div>
            </a>
        </div>

        {{-- <div class=" block px-6">
            <a href="{{ url("/profile/show") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("profile", "profile/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("profile", "profile/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
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
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("promotions", "promotions/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <h1 class=" block">Promotions</h1>
            </a>
        </div> --}}

        <div class=" block px-6">
            <a href="{{ url("/client/renewal") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("client/renewal", "client/renewal/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("client/renewal", "client/renewal/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("client/renewal", "client/renewal/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <h1 class=" block">Renewal</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/profile/show") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("profile", "profile/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("profile", "profile/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("profile", "profile/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <h1 class=" block">Profile</h1>
            </a>
        </div>

        <div class=" block lg:hidden px-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="p-2 flex items-center w-full gap-2 rounded-md bg-red-500 text-white font-bold hover:bg-red-600 transition duration-300">
                    <i class="fa-solid fa-power-off"></i>
                    <h1 class="block">Logout</h1>
                </button>
            </form>
        </div>
        

    @elseif ($link === 'content_writer')
        <div class=" block px-6">
            <a href="{{ url("/dashboard") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("dashboard", "dashboard/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("dashboard", "dashboard/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class=" p-2 rounded-lg w-10 h-10 {{ request()->is("dashboard", "dashboard/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="project Icon">
                <h1 class=" block">Dashboard</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/content") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("content", "content/edit/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("content", "content/edit/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("content", "content/edit/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <div class="flex justify-between w-full">
                    <p class=" block">My Tasks</p>
                    <p class="mr-10 text-[.8rem] py-1 text-white px-2 rounded-lg bg-red-600 {{$operationRevisionCount < 1 ? "hidden" : ""}}">{{ $operationRevisionCount }}</p>
                </div>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/profile/show") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("profile", "profile/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("profile", "profile/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("profile", "profile/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <h1 class=" block">Profile</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/content/revisions") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("content/revisions", "content/revisions/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("content/revisions", "content/revisions/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("content/revisions", "content/revisions/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <div class="flex justify-between w-full">
                    <p class=" block">Revision Checklist</p>
                    <p class="mr-10 text-[.8rem] py-1 text-white px-2 rounded-lg bg-red-600 {{$contentRevisionCount < 1 ? "hidden" : ""}}">{{ $contentRevisionCount }}</p>
                </div>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/content/history") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("content/history", "content/history/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("content/history", "content/history/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("content/history", "content/history/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <h1 class=" block">Downloadables</h1>
            </a>
        </div>

        <div class=" block lg:hidden px-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="p-2 flex items-center w-full gap-2 rounded-md bg-red-500 text-white font-bold hover:bg-red-600 transition duration-300">
                    <i class="fa-solid fa-power-off"></i>
                    <h1 class="block">Logout</h1>
                </button>
            </form>
        </div>
    @elseif ($link === 'graphic_designer')
        <div class=" block px-6">
            <a href="{{ url("/dashboard") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("dashboard", "dashboard/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("dashboard", "dashboard/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
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
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("graphic", "graphic") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <div class="flex justify-between w-full">
                    <p class=" block">My Tasks</p>
                    <p class="mr-10 text-[.8rem] py-1 text-white px-2 rounded-lg bg-red-600 {{$graphicDraftCount < 1 ? "hidden" : ""}}">{{ $graphicDraftCount }}</p>
                </div>
            </a>
        </div>
        <div class=" block px-6">
            <a href="{{ url("/graphic/revisions") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("graphic/revisions", "graphic/revisions/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("graphic/revisions", "graphic/revisions/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("graphic/revisions", "graphic/revisions/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <div class="flex justify-between w-full">
                    <p class=" block">Revision Checklist</p>
                    <p class="mr-10 text-[.8rem] py-1 text-white px-2 rounded-lg bg-red-600 {{$graphicRevisionCount < 1 ? "hidden" : ""}}">{{ $graphicRevisionCount }}</p>
                </div>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/graphic/history") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("graphic/history", "graphic/history/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("graphic/history", "graphic/history/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("graphic/history", "graphic/history/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <h1 class=" block">Downloadables</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/profile/show") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("profile", "profile/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("profile", "profile/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("profile", "profile/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <h1 class=" block">Profile</h1>
            </a>
        </div>

        <div class=" block lg:hidden px-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="p-2 flex items-center w-full gap-2 rounded-md bg-red-500 text-white font-bold hover:bg-red-600 transition duration-300">
                    <i class="fa-solid fa-power-off"></i>
                    <h1 class="block">Logout</h1>
                </button>
            </form>
        </div>
    @elseif ($link === 'top_manager')
        {{-- Admin Sidebar Menu --}}
        <div class=" block px-6">
            <a href="{{ url("/dashboard") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("dashboard", "dashboard/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("dashboard", "dashboard/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
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
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("topmanager", "topmanager/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Project Development Icon">
                <h1 class=" block">Approval</h1>
            </a>
        </div>

        {{-- <div class=" block px-6">
            <a href="{{ url("/profile/show") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("profile", "profile/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("profile", "profile/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
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
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
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
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
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
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("manual", "manual/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <h1 class=" block">Instruction Manual</h1>
            </a>
        </div> --}}

        <div class=" block px-6">
            <a href="{{ url("/profile/show") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("profile", "profile/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("profile", "profile/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("profile", "profile/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Profile Icon">
                <h1 class=" block">Profile</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/users") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("users", "users/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("users", "users/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("users", "users/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="joborder Icon">
                <h1 class=" block">Add users</h1>
            </a>
        </div>

        <div class=" block lg:hidden px-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="p-2 flex items-center w-full gap-2 rounded-md bg-red-500 text-white font-bold hover:bg-red-600 transition duration-300">
                    <i class="fa-solid fa-power-off"></i>
                    <h1 class="block">Logout</h1>
                </button>
            </form>
        </div>

    @elseif ($link == "supervisor")

        <div class=" block px-6">
            <a href="{{ url("/dashboard") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("dashboard", "dashboard/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("dashboard", "dashboard/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class=" p-2 rounded-lg w-10 h-10 {{ request()->is("dashboard", "dashboard/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="project Icon">
                <h1 class=" block">Dashboard</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/supervisor/joborder") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("supervisor/joborder", "supervisor/joborder/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("supervisor/joborder", "supervisor/joborder/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("supervisor/joborder", "supervisor/joborder/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Project Development Icon">
                <div class="flex justify-between w-full">
                    <p class=" block">Operation Job Order</p>
                    <p class="mr-10 text-[.8rem] py-1 text-white px-2 rounded-lg bg-red-600 {{$supervisorDraftCount < 1 ? "hidden" : ""}}">{{ $supervisorDraftCount }}</p>
                </div>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/supervisor/directjob") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("supervisor/directjob", "supervisor/directjob/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("supervisor/directjob", "supervisor/directjob/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("supervisor/directjob", "supervisor/directjob/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Project Development Icon">
                <h1 class=" block">Direct Job Orders</h1>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/supervisor/task") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("supervisor/task", "supervisor/task/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("supervisor/task", "supervisor/task/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("supervisor/task", "supervisor/task/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Project Development Icon">
                <div class="flex justify-between w-full">
                    <p class=" block">My Tasks</p>
                    <p class="mr-10 text-[.8rem] py-1 text-white px-2 rounded-lg bg-red-600 {{$supervisorTaskCount < 1 ? "hidden" : ""}}">{{ $supervisorTaskCount }}</p>
                </div>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/supervisor/revision") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("supervisor/revision", "supervisor/revision/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("supervisor/revision", "supervisor/revision/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class="p-2 rounded-lg w-10 h-10 {{ request()->is("supervisor/revision", "supervisor/revision/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="Project Development Icon">
                <div class="flex justify-between w-full">
                    <p class=" block">Revisions</p>
                    <p class="mr-10 text-[.8rem] py-1 text-white px-2 rounded-lg bg-red-600 {{$supervisorRevisionCount < 1 ? "hidden" : ""}}">{{ $supervisorRevisionCount }}</p>
                </div>
            </a>
        </div>

        <div class=" block px-6">
            <a href="{{ url("/supervisor/approve") }}"
                class="p-2 flex items-center w-full gap-2 rounded-md 
                {{ request()->is("supervisor/approve", "supervisor/approve/*") ? 'bg-[#f68e12] text-white font-bold' : '' }}"
                style="{{ request()->is("supervisor/approve", "supervisor/approve/*") ? 'box-shadow: 0 1px 10px rgba(0, 0, 0, 0.6);' : '' }}">
                <img src="{{asset('/Assets/icon-profile-white.png')}}"
                    draggable="false"
                    class=" p-2 rounded-lg w-10 h-10 {{ request()->is("supervisor/approve", "supervisor/approve/*") ? 'bg-black' : 'bg-[#f66d11]' }}"
                    alt="project Icon">
                <div class="flex justify-between w-full">
                    <p class=" block">Approvals</p>
                    <p class="mr-10 text-[.8rem] py-1 text-white px-2 rounded-lg bg-red-600 {{$supervisorApprovalCount < 1 ? "hidden" : ""}}">{{ $supervisorApprovalCount }}</p>
                </div>
            </a>
        </div>

        <div class=" block lg:hidden px-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="p-2 flex items-center w-full gap-2 rounded-md bg-red-500 text-white font-bold hover:bg-red-600 transition duration-300">
                    <i class="fa-solid fa-power-off"></i>
                    <h1 class="block">Logout</h1>
                </button>
            </form>
        </div>
    @endif
</div>

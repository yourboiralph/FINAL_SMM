@extends('layouts.application')

@section('title', 'Page Title')
@section('header', "Users") 

@section('content')
@php
    $roles = [
        1 => 'Client',
        2 => 'Operations Manager',
        3 => 'Content Writer',
        4 => 'Graphic Designer',
        5 => 'Top Manager'
    ];
@endphp
<div class="container mx-auto p-6">

    {{-- Search Bar --}}
    <div class="w-full flex flex-col md:flex-row justify-between items-center gap-4 mb-4">
        <a href="{{ url('register') }}">
            <div class="bg-[#fa7011] text-white px-4 py-2 rounded-lg shadow-md hover:bg-cyan-800 transition text-center w-full md:w-auto">
                Create New User
            </div>
        </a>
        <div class="flex items-center w-full md:w-auto relative">
            <i class="fa-solid fa-magnifying-glass absolute left-4 text-gray-500"></i>
            <input type="text" id="searchInput"
                class="w-full md:w-80 px-10 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                placeholder="Search..." />
            <button class="absolute right-2 px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">
                <i class="fa-solid fa-filter"></i>
            </button>
        </div>
    </div>

    {{-- Table Wrapper --}}
    <div class="overflow-x-auto overflow-y-auto bg-white shadow-md rounded-lg" style="max-height: 500px;">
        <table class="w-full text-left border-collapse min-w-[500px]">
            <thead class="sticky top-0 bg-[#fa7011] text-white">
                <tr>
                    <th class="px-6 py-3">Users</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach ($users as $user)
                    <tr class="border-b">
                        <td class="px-6 py-3">{{ $user->name }}</td>
                        <td class="px-6 py-3">{{ $roles[$user->role_id] ?? 'Unknown' }}</td>
                        <td class="px-6 py-3">
                            <a href="{{ url('users/edit/' . $user->id) }}">
                                <button class="px-2 py-1 mb-2 lg:mb-0 lg:px-4 lg:py-2 text-sm text-white bg-orange-500 rounded hover:bg-orange-600">
                                    Edit
                                </button>
                            </a>
                            <a href="{{ url('users/show/' . $user->id) }}">
                                <button class="px-2 py-1 lg:px-4 lg:py-2 text-sm text-white bg-gray-700 rounded hover:bg-gray-800">
                                    Show
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination Links --}}
    <div class="mt-4">
        {{-- {{ $list_of_projects->links('vendor.pagination.custom') }} --}}
    </div>
</div>
@endsection

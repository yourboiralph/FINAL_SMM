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
    <div class="w-full h-fit flex justify-between ">
        <a href="{{ url('register') }}">
            <div class="bg-[#fa7011] text-white px-4 py-2 rounded-lg shadow-md hover:bg-cyan-800 transition">

                Create New Users

            </div>
        </a>
        <div class="flex items-center mb-4 relative w-fit">
            <i class="fa-solid fa-magnifying-glass absolute pl-4"></i>
            <button class="absolute right-2 px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">
                <i class="fa-solid fa-filter"></i>
            </button>
            <input type="text" id="searchInput"
                class="px-10 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                placeholder="Search..." />
        </div>
    </div>

    {{-- Table Wrapper --}}
    <div class="h-96 overflow-auto">
        <table class="w-full text-left border-collapse" id="projectTable">
            <thead class="sticky top-0 bg-[#fa7011] text-white">
                <tr>
                    <th class="px-6 py-3">Users</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach ($users as $user)
                    <tr class="project-row">
                        <td class="px-6 py-3">{{ $user->name }}</td>                     
                        <td class="px-6 py-3">{{ $roles[$user->role_id] ?? 'Unknown' }}</td>                  
                        <td class="px-6 py-3">
                            <a href="{{url('users/edit/' . $user->id)}}">
                                <button class="px-4 py-2 text-sm text-white bg-orange-500 rounded hover:bg-orange-600">
                                    Edit
                                </button>
                            </a>
                            <a href="{{url('users/show/'. $user->id)}}">

                                <button class="px-4 py-2 text-sm text-white bg-gray-700 rounded hover:bg-gray-800">
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


{{-- <a href="{{url('register')}}">Create a new user</a>

@foreach ($users as $user )
<div>

    <p>
        <div>

            {{$user->name}}
        </div>
         <a href="{{url('users/show/' . $user->id)}}">Show</a>
         <a href="{{url('users/edit/' . $user->id)}}">Edit</a>
     </p> 
     
</div>
@endforeach --}}
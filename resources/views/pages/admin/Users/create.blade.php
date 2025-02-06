@extends('layouts.application')

@section('title', 'Register')
@section('header', 'User Registration')

@section('content')

<style>
    .custom-shadow {
        box-shadow: 0 4px 6px rgba(0, 0, 0, .3), 0 1px 3px rgba(0, 0, 0, .3);
    }
    .custom-hover-shadow:hover {
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0), 0 4px 6px rgba(0, 0, 0, 0);
        transition: box-shadow 0.3s ease;
    }
    .custom-focus-ring:focus {
        outline: none;
        box-shadow: 0 0 0 1px #fa7011;
        transition: box-shadow 0.3s ease;
    }
</style>

<div class="container mx-auto p-6">
    <div class="bg-[#ffaa71] w-1/2 px-6 py-10 mx-auto rounded-lg custom-shadow">
        <div>
            <a href="{{url('users')}}">
                <div class="w-fit px-4 py-1 bg-[#fa7011] rounded-md text-white custom-shadow custom-hover-shadow">
                    Go Back
                </div>
            </a>
        </div>
        <form method="POST" action="{{ url('register') }}" enctype="multipart/form-data">
            @csrf
            
            <h1 class="mt-10 text-xl font-bold">Register User</h1>
            <div class="grid grid-cols-2 pb-10 space-y-4">
                <div class="w-full col-span-2">
                    <p class="text-sm text-gray-600">Name</p>
                    <input type="text" name="name" class="w-full border-gray-200 rounded-lg custom-shadow custom-focus-ring" required>
                    @error('name')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-span-2 grid grid-cols-2 gap-4">
                    <div class="w-full">
                        <p class="text-sm text-gray-600">Role</p>
                        <select name="role_id" id="" class="w-full border-gray-200 rounded-lg custom-shadow custom-focus-ring" required>
                            <option value="">Select a role</option>
                            <option value="1">Client</option>
                            <option value="2">Operations Manager</option>
                            <option value="3">Content Writer</option>
                            <option value="4">Graphic Designer</option>
                            <option value="5">Top Manager</option>
                        </select>
                        @error('role_id')
                            <p class="text-red-600 text-sm">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="w-full">
                        <p class="text-sm text-gray-600">Phone</p>
                        <input type="text" name="phone" class="w-full border-gray-200 rounded-lg custom-shadow custom-focus-ring" required>
                        @error('phone')
                            <p class="text-red-600 text-sm">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="w-full col-span-2">
                    <p class="text-sm text-gray-600">Address</p>
                    <input type="text" name="address" class="w-full border-gray-200 rounded-lg custom-shadow custom-focus-ring" required>
                    @error('address')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>

                <div class="w-full col-span-2">
                    <p class="text-sm text-gray-600">Image</p>
                    <input type="file" name="image" class="w-full border-gray-200 rounded-lg custom-shadow custom-focus-ring" required>
                    @error('image')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>

                <div class="w-full col-span-2">
                    <p class="text-sm text-gray-600">Email</p>
                    <input type="email" name="email" class="w-full border-gray-200 rounded-lg custom-shadow custom-focus-ring" required>
                    @error('email')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-span-2 grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Password</p>
                        <input type="password" name="password" class="w-full rounded-lg custom-shadow custom-focus-ring" required>
                        @error('password')
                            <p class="text-red-600 text-sm">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Confirm Password</p>
                        <input type="password" name="password_confirmation" class="w-full rounded-lg custom-shadow custom-focus-ring" required>
                        @error('password_confirmation')
                            <p class="text-red-600 text-sm">{{$message}}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-span-2 text-center py-4 w-full bg-[#fa7011] mt-10 rounded-lg custom-shadow custom-hover-shadow">
                    <button type="submit" class="text-white font-bold">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

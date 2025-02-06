@extends('layouts.application')

@section('title', 'Page Title')
@section('header', "Job Order") 

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
            <a href="{{url('/joborder')}}">
                <div class="w-fit px-4 py-1 bg-[#fa7011] rounded-md text-white custom-shadow custom-hover-shadow">
                    Back
                </div>
            </a>
        </div>
        <form action="{{ url('/joborder/update/' . $job_order->id ) }}" method="POST">
            @csrf
            @method('PUT')
            <h1 class="mt-10 text-xl font-bold">Edit Form</h1>
            <div class="grid grid-cols-2 pb-10 space-y-4">
                <div class="col-span-2 grid grid-cols-2 gap-4 mt-10">
                    <div class="w-full">
                        <p class="text-sm text-gray-600">Title</p>
                        <p class="text-sm text-gray-600">{{$job_order->type}}</p>
                        <input type="text" name="title" class="w-full border-gray-200 rounded-lg custom-shadow custom-focus-ring" value="{{ old('title', $job_order->title) }}">
                        @error('title')
                            <p class="text-red-600 text-sm">{{$message}}</p>
                        @enderror
                    </div>

                        <div class="w-full">
                            <p class="text-sm text-gray-600">Graphics Designer</p>
                            <select name="graphic_designer_id" class="w-full border-gray-200 rounded-lg custom-shadow custom-focus-ring">
                                @foreach ($graphic_designers as $graphic_designer)
                                    <option value="{{ $graphic_designer->id }}" 
                                        {{ $job_order->graphic_designer_id == $graphic_designer->id ? 'selected' : '' }}>
                                        {{ $graphic_designer->name }}
                                    </option>
                                @endforeach
                            </select>
                            
                            @error('designer_id')
                                <p class="text-red-600 text-sm">{{$message}}</p>
                            @enderror
                        </div>
                    @if ($job_order->latest_job_draft->type === 'content_writer')
                        <div class="w-full">
                            <p class="text-sm text-gray-600">Content Writer</p>
                            <select name="content_writer_id" class="w-full border-gray-200 rounded-lg custom-shadow custom-focus-ring">
                                @foreach ($content_writers as $content_writer)
                                    <option >{{$content_writer->name}}</option>
                                @endforeach                  
                            </select>
                            @error('writer_id')
                                <p class="text-red-600 text-sm">{{$message}}</p>
                            @enderror
                        </div>
                    @endif
                </div>

                <div class="col-span-2 w-full">
                    <p class="text-sm text-gray-600">Description</p>
                    <textarea name="description" class="w-full border-gray-200 rounded-lg custom-shadow custom-focus-ring resize-none">{{ old('description', $job_order->description) }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-span-2 grid grid-cols-2 w-full gap-4 rounded-lg">
                    <div>
                        <p class="text-sm text-gray-600">Date Started</p>
                        <input type="date" name="date_started" class="w-full rounded-lg custom-shadow custom-focus-ring" value="{{ old('date_started', $job_order->date_started) }}">
                        @error('date_started')
                            <p class="text-red-600 text-sm">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Date Deadline</p>
                        <input type="date" name="date_deadline" class="w-full rounded-lg custom-shadow custom-focus-ring" value="{{ old('date_deadline', $job_order->date_deadline) }}">
                        @error('date_deadline')
                            <p class="text-red-600 text-sm">{{$message}}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-span-2 text-center py-4 w-full bg-[#fa7011] mt-10 rounded-lg custom-shadow custom-hover-shadow">
                    <button type="submit" class="text-white font-bold">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.application')

@section('title', 'Admin')
@section('header', 'Show Job Order')

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

<!-- CKEditor 5 Classic -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<div class="container mx-auto p-6">
    <div class="w-full px-6 py-10 mx-auto rounded-lg custom-shadow bg-white">
        <div class="flex items-center justify-between">
            <a href="{{ url('/operation/requests') }}">
                <div class="w-fit px-4 py-1 bg-gray-400 rounded-md text-white custom-shadow custom-hover-shadow">
                    Back
                </div>
            </a>
            <a href="{{ url('/operation/request/create/' . $supervisor_request->id) }}">
                <div class="w-fit px-4 py-1 bg-[#fa7011] rounded-md text-white custom-shadow custom-hover-shadow">
                    Create Draft
                </div>
            </a>

        </div>
        <h1 class="text-xl font-bold mt-4">Show</h1>
        <div class="mt-4 grid grid-cols-4">
            <div class="col-span-4 flex flex-col space-y-4 mb-10 md:flex-row  md:space-y-0">
                <div class="w-full">
                    <p class="text-sm font-bold text-gray-600">Title</p>
                    <p class="border-b-2 border-[#fa7011] w-fit">{{ $supervisor_request->title }}</p>
                </div>
                <div class="w-full">
                    <p class="text-sm font-bold text-gray-600">Issued By</p>
                    <p class="border-b-2 border-[#fa7011] w-fit">{{ $supervisor_request->issuer->name }}</p>
                </div>
            </div>
            <div class="col-span-4 h-fit">
                <p class="text-sm font-bold text-gray-600">Description</p>

                <!-- CKEditor Read-Only -->
                <div class="border border-gray-400 rounded-lg break-words max-h-[500px] p-2 overflow-y-auto">
                    {!! $supervisor_request->description !!}
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    // Initialize CKEditor in Read-Only mode
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: false, // Hide toolbar since it's read-only
            readOnly: true // Disable editing
        })
        .then(editor => {
            console.log('CKEditor (Read-Only) initialized');
        })
        .catch(error => {
            console.error(error);
        });
</script>

@endsection

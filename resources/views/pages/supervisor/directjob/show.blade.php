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
    <div class="w-full px-6 py-10 mx-auto rounded-lg custom-shadow">
        <div>
            <a href="{{ url('/supervisor/directjob') }}">
                <div class="w-fit px-4 py-1 bg-[#fa7011] rounded-md text-white custom-shadow custom-hover-shadow">
                    Back
                </div>
            </a>
        </div>
        <h1 class="text-xl font-bold mt-4">Show</h1>
        <div class="mt-4 grid grid-cols-4">
            <div class="col-span-4 flex flex-col space-y-4 mb-10 md:flex-row  md:space-y-0">
                <div class="w-full">
                    <p class="text-sm font-bold text-gray-600">Title</p>
                    <p class="border-b-2 border-[#fa7011] w-fit">{{ $job_draft->jobOrder->title }}</p>
                </div>
                <div class="w-full">
                    <p class="text-sm font-bold text-gray-600">Client</p>
                    <p class="border-b-2 border-[#fa7011] w-fit">{{ $job_draft->client->name }}</p>
                </div>
                <div class="w-full">
                    <p class="text-sm font-bold text-gray-600">Date Started</p>
                    <p class="border-b-2 border-[#fa7011] w-fit">{{ $job_draft->date_started }}</p>
                </div>
                <div class="w-full">
                    <p class="text-sm font-bold text-gray-600">Deadline</p>
                    <p class="border-b-2 border-[#fa7011] w-fit">{{ $job_draft->date_target }}</p>
                </div>
            </div>
            <div class="col-span-4 h-fit">
                <p class="text-sm font-bold text-gray-600">Description</p>
                
                <!-- CKEditor Read-Only -->
                <div class="text-sm text-gray-600 w-full max-h-[500px] overflow-y-auto bg-white border border-gray-300 p-2 rounded">
                    {!! $job_draft->jobOrder->description !!}
                </div>
                

                {{-- Graphic Designer & Content Writer --}}
                <div class="mt-8 flex sm:flex-row gap-8 justify-center sm:justify-normal">
                    <div class="flex flex-col items-center">
                        <img class="w-14 h-14 md:w-16 md:h-16 rounded-full" src="/Assets/user-profile-profilepage.png" alt="Graphic Designer">
                        <h1 class="text-sm mt-2">{{ $job_draft->graphicDesigner->name }}</h1>
                        <h1 class="text-xs border-b-2 border-[#fa7011] w-fit">Graphic Designer</h1>
                    </div>
                    <div class="flex flex-col items-center">
                        <img class="w-14 h-14 md:w-16 md:h-16 rounded-full" src="/Assets/user-profile-profilepage.png" alt="Content Writer">
                        <h1 class="text-sm mt-2">{{ $job_draft->contentWriter->name }}</h1>
                        <h1 class="text-xs border-b-2 border-[#fa7011] w-fit">Content Writer</h1>
                    </div>
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

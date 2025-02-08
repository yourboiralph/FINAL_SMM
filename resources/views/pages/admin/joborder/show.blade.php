@extends('layouts.application')

@section('title', 'Job Order')
@section('header', 'Job Order')

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
            <a href="{{ url('/joborder') }}">
                <div class="w-fit px-4 py-1 bg-[#fa7011] rounded-md text-white custom-shadow custom-hover-shadow">
                    Back
                </div>
            </a>
        </div>
        <h1 class="text-xl font-bold mt-4">Show</h1>
        <div class="mt-4 grid grid-cols-4">
            <div class="col-span-4 flex mb-10">
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
                    <p >{{ $job_draft->date_target }}</p>
                </div>
            </div>
            <div class="col-span-4 h-fit">
                <p class="text-sm font-bold text-gray-600">Description</p>
                
                <!-- CKEditor Read-Only -->
                <p class="border-b-2 border-[#fa7011] w-fit">{!! $job_draft->joborder->description !!}</p>

            </div>
            <div class="mt-10 flex gap-8">
                <div class="flex items-center justify-center flex-col">
                    <img class="size-14" src="/Assets/user-profile-profilepage.png" alt="">
                    <h1 class="text-sm">{{ $job_draft->graphicDesigner->name }}</h1>
                    <h1 class="text-[10px] border-b-2 border-[#fa7011] w-fit">Graphic Designer</h1>
                </div>
                <div class="flex items-center justify-center flex-col">
                    <img class="size-14" src="/Assets/user-profile-profilepage.png" alt="">
                    <h1 class="text-sm">{{ $job_draft->contentWriter->name }}</h1>
                    <h1 class="text-[10px] border-b-2 border-[#fa7011] w-fit">Content Writer</h1>
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

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
        box-shadow: 0 0 0 1px #545454;
        transition: box-shadow 0.3s ease;
    }
    #quill-editor {
        min-height: 200px; /* Ensure enough space for the editor */
    }
</style>

<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<div class="container mx-auto p-6">
    <div class=" w-full px-6 py-10 mx-auto rounded-lg custom-shadow">
        <div>
            <a href="{{url('/content')}}">
                <div class="w-fit px-4 py-1 bg-[#fa7011] rounded-md text-white custom-shadow custom-hover-shadow">
                    Back
                </div>
            </a>
        </div>
        <form action="{{ url('/content/update/'. $job_draft->id ) }}" method="POST">
            @csrf
            @method('PUT')
            <h1 class="text-xl font-bold mt-4">Create Draft</h1>
            <div class="grid grid-cols-4 space-y-4">
                <div class="col-span-4 grid grid-cols-2 gap-4 mt-4">
                    <div class="col-span-4 grid grid-cols-4">
                        <div class="col-span-1 w-full">
                            <p class="text-sm text-gray-600 border-[#fa7011] border-b-2 w-fit">Title</p>
                            <p class="text-xl font-bold">{{$job_draft->jobOrder->title}}</p>
                        </div>
                        <div class="col-span-1 w-full">
                            <p class="text-sm text-gray-600 border-[#fa7011] border-b-2 w-fit">Client</p>
                            <p class="text-xl font-bold">{{$job_draft->client->name}}</p>
                        </div>
                        <div class="col-span-1 w-full">
                            <p class="text-sm text-gray-600 border-[#fa7011] border-b-2 w-fit">Date Started</p>
                            <p class="text-xl font-bold">{{ \Carbon\Carbon::parse($job_draft->date_started)->format('Y-m-d') }}</p>
                        </div>
                        <div class="col-span-1 w-full">
                            <p class="text-sm text-gray-600 border-[#fa7011] border-b-2 w-fit">Date Target</p>
                            <p class="text-xl font-bold">{{ \Carbon\Carbon::parse($job_draft->date_target)->format('Y-m-d') }}</p>
                        </div>
                    </div>

                    <div class="col-span-2 h-fit w-full">
                        <p class="text-sm text-gray-600">Draft</p>
                        
                        <!-- Quill Editor -->
                        <div id="quill-editor" class="w-full border-gray-200 rounded-lg custom-shadow custom-focus-ring min-h-[300px] max-h-[500px] overflow-y-auto"></div>
                    
                        <!-- Hidden textarea to store Quill content -->
                        <textarea name="draft" id="description" class="hidden max-h-[300px]"></textarea>
                    
                        @error('description')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="col-span-1 text-center py-4 w-full bg-[#fa7011] mt-10 rounded-lg custom-shadow custom-hover-shadow text-white font-bold">
                    Submit
                </button>
                
            </div>
        </form>
    </div>
</div>
<script>
    var quill = new Quill('#quill-editor', {
        theme: 'snow', // Snow theme with toolbar
        placeholder: 'Write something...',
        modules: {
            toolbar: [
                [{ 'bold': true }, { 'italic': true }, { 'underline': true }], // Text Formatting
                [{ 'list': 'ordered' }, { 'list': 'bullet' }], // Lists
                [{ 'align': [] }], // Alignment
                ['link'], // Add links
                ['clean'] // Remove formatting
            ]
        },
        scrollingContainer: '#quill-editor' // Ensure scrolling works
    });

    // Store Quill content into the hidden textarea before form submission
    document.querySelector('form').onsubmit = function() {
        document.querySelector('#description').value = quill.root.innerHTML;
    };
</script>

@endsection

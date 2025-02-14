@extends('layouts.application')

@section('title', 'Revision')
@section('header', "Content Revision") 

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
</style>

<!-- CKEditor 5 CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<div class="container mx-auto p-6">
    <div class="w-full px-6 py-10 mx-auto rounded-lg custom-shadow">
        <div>
            <a href="{{ url('/content/revisions') }}">
                <div class="w-fit px-4 py-1 bg-[#fa7011] rounded-md text-white custom-shadow custom-hover-shadow">
                    Back
                </div>
            </a>
        </div>
        <form action="{{ url('/content/revisions/update/' . $job_draft->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h1 class="text-xl font-bold mt-4">Create Draft</h1>
            <div class="grid grid-cols-4 space-y-4">
                <div class="col-span-4 grid grid-cols-2 gap-4 mt-4">
                    <div class="col-span-4 grid grid-cols-4">
                        <div class="col-span-1 w-full">
                            <p class="text-sm text-gray-600 border-[#fa7011] border-b-2 w-fit">Title</p>
                            <p class="text-xl font-bold">{{ $job_draft->jobOrder->title }}</p>
                        </div>
                        <div class="col-span-1 w-full">
                            <p class="text-sm text-gray-600 border-[#fa7011] border-b-2 w-fit">Client</p>
                            <p class="text-xl font-bold">{{ $job_draft->client->name }}</p>
                        </div>
                        <div class="col-span-1 w-full">
                            <p class="text-sm text-gray-600 border-[#fa7011] border-b-2 w-fit">Date Started</p>
                            <p class="text-xl font-bold">{{ \Carbon\Carbon::parse($job_draft->date_started)->format('Y-m-d') }}</p>
                        </div>
                        <div class="col-span-1 w-full">
                            <p class="text-sm text-gray-600 border-[#fa7011] border-b-2 w-fit">Date Target</p>
                            <p class="text-xl font-bold">{{ \Carbon\Carbon::parse($job_draft->date_target)->format('Y-m-d') }}</p>
                        </div>
                        <div class="w-full col-span-4 grid grid-cols-4 justify-between">
                            <div class="col-span-3 w-full mt-4">
                                <p class="text-sm text-gray-600 border-[#fa7011] border-b-2 w-fit">Revisions</p>
                                <p class="text-xl font-bold">{!! $job_draft->revisions->last()->summary !!}</p>
                            </div>
                            <div class="col-span-1 w-full mt-4">
                                <p class="text-sm text-gray-600 border-[#fa7011] border-b-2 w-fit">Revision By</p>
                                <p class="">{{ $job_draft->revisions->last()->declinedBy->name }}</p>
                            </div>
                        </div>
                        <div class="col-span-4 w-full mt-4">
                            <p class="text-sm text-gray-600 border-[#fa7011] border-b-2 w-fit">Description</p>
                            <p class="text-xl font-bold">{!! $job_draft->jobOrder->description !!}</p>
                        </div>
                    </div>

                    <div class="col-span-4 h-fit w-full">
                        <p class="text-sm text-gray-600">Last Draft</p>
                        
                        <!-- CKEditor 5 textarea -->
                        <p class="max-h-96 overflow-y-auto">{!! $job_draft->draft !!}</p>
                    
                        @error('draft')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="border border-gray-200 col-span-4" />

                    <div class="col-span-2 h-fit w-full">
                        <p class="text-sm text-gray-600">Draft</p>
                        
                        <!-- CKEditor 5 textarea -->
                        <textarea name="draft" id="editor" class="w-full border-gray-200 rounded-lg custom-shadow custom-focus-ring min-h-[300px]"></textarea>
                    
                        @error('draft')
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
    document.addEventListener("DOMContentLoaded", function () {
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log('CKEditor 5 initialized!', editor);
                
                // Load existing content
                editor.setData();

                // Before form submission, update the textarea with editor data
                document.querySelector("form").addEventListener("submit", function () {
                    document.querySelector("#editor").value = editor.getData();
                });

            })
            .catch(error => {
                console.error('Error initializing CKEditor 5:', error);
            });
    });
</script>

@endsection

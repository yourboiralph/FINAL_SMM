@extends('layouts.application')

@section('title', 'Admin')
@section('header', "Edit Job Order") 

@section('content')

<style>
    .custom-shadow {
        box-shadow: 0 2px 4px rgba(0, 0, 0, .3), 0 1px 3px rgba(0, 0, 0, .3);
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
        <form action="{{ url('/joborder/update/'. $job_draft->id ) }}" method="POST">
            @csrf
            @method('PUT')
            <h1 class="text-xl font-bold mt-4">Edit Form</h1>
            <div class="grid grid-cols-4 space-y-4">
                <div class="col-span-4 grid grid-cols-2 gap-4 mt-4">
                    <div class="w-full">
                        <p class="text-sm text-gray-600">Title</p>
                        <input type="text" name="title" class="w-full border-gray-200 rounded-lg" value="{{ old('title', $job_draft->jobOrder->title) }}">
                        @error('title')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    @if ($job_draft->type === 'graphic_designer')
                        <div class="w-full">
                            <p class="text-sm text-gray-600">Graphics Designer</p>
                            <select name="graphic_designer_id" class="w-full border-gray-200 rounded-lg">
                                @foreach ($graphic_designers as $graphic_designer)
                                    <option value="{{ $graphic_designer->id }}" 
                                        {{ $job_draft->graphicDesigner->id == $graphic_designer->id ? 'selected' : '' }}>
                                        {{ $graphic_designer->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('designer_id')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    @elseif ($job_draft->type === 'content_writer')
                        <div class="w-full">
                            <p class="text-sm text-gray-600">Content Writer</p>
                            <select name="content_writer_id" class="w-full border-gray-200 rounded-lg">
                                @foreach ($content_writers as $content_writer)
                                    <option value="{{ $content_writer->id }}" 
                                        {{ $job_draft->contentWriter->id == $content_writer->id ? 'selected' : '' }}>
                                        {{ $content_writer->name }}
                                    </option>
                                @endforeach                
                            </select>
                            @error('writer_id')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif
                    <div class="col-span-1 w-full">
                        <p class="text-sm text-gray-600">Client</p>
                        <div class="relative">
                            <input type="text" id="selected-client-name" class="w-full border-gray-200 rounded-lg cursor-pointer" 
       value="{{ old('title', $job_draft->client->name) }}" readonly onclick="openModal()">
                            <input type="hidden" name="client_id" id="selected-client-id" value="{{ old('client_id', $job_draft->client->id) }}">
                        </div>
                        @error('client')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div class="col-span-1 grid grid-cols-2 w-full gap-4 rounded-lg">
                        <div>
                            <p class="text-sm text-gray-600">Date Started</p>
                            <input type="date" name="date_started" class="w-full rounded-lg border-gray-200" value="{{ \Carbon\Carbon::parse($job_draft->date_started)->format('Y-m-d') }}">
                            @error('date_started')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 text-nowrap">Date Deadline</p>
                            <input type="date" name="date_target" class="w-full rounded-lg border-gray-200" value="{{ \Carbon\Carbon::parse($job_draft->date_target)->format('Y-m-d') }}">
                            @error('date_target')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-2 h-fit w-full">
                        <p class="text-sm text-gray-600">Description</p>
                        
                        <!-- CKEditor Textarea -->
                        <textarea name="description" id="editor" class="w-full border-gray-200 rounded-lg">{{ $job_draft->jobOrder->description }}</textarea>
                    
                        @error('description')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="col-span-1 text-center py-4 w-full bg-[#fa7011] mt-10 rounded-lg text-white font-bold">
                    Submit
                </button>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div id="client-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg w-96">
            <h2 class="text-lg font-semibold mb-4">Select a Client</h2>
            <ul class="max-h-60 overflow-y-auto">
                @foreach($clients as $client)
                <li class="p-2 border-b cursor-pointer hover:bg-gray-100" onclick="selectClient('{{ $client->id }}', '{{ $client->name }}')">
                    {{ $client->name }}
                </li>
                @endforeach
            </ul>
            <button onclick="closeModal()" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded">Close</button>
        </div>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('client-modal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('client-modal').classList.add('hidden');
    }
    function selectClient(clientId, clientName) {
        document.getElementById('selected-client-name').value = clientName;
        document.getElementById('selected-client-id').value = clientId;
        closeModal();
    }

    // Initialize CKEditor
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            console.log('CKEditor initialized');
        })
        .catch(error => {
            console.error(error);
        });
</script>

@endsection

@extends('layouts.application')

@section('title', 'Admin')
@section('header', "Create Job Order") 

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

<!-- CKEditor 5 Classic CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<div class="container mx-auto p-6">
    <div class="w-full px-6 py-10 mx-auto rounded-lg custom-shadow">
                {{-- Success Message Component --}}
                @if(session('Status'))
                <x-success />
            @endif
        <div>
            <a href="{{ url('/joborder') }}">
                <div class="w-fit px-4 py-1 bg-[#fa7011] rounded-md text-white custom-shadow custom-hover-shadow">
                    Back
                </div>
            </a>
        </div>
        <form action="{{ url('/operation/request/store') }}" method="POST">
            @csrf
            
            <h1 class="text-xl font-bold mt-4 mb-10">Create Job Order</h1>
            <div class="mb-4">
                <p class="text-sm text-gray-600">Instructions</p>
                <p class="text-sm text-gray-600 w-full">{!! $supervisor_request->description !!}</p>
            </div>
            <hr class="border border-gray-400" />
            <div class="grid grid-cols-4 space-y-4">
                <div class="col-span-4 grid grid-cols-2 gap-4 mt-4">
                    <div class="w-full">
                        <p class="text-sm text-gray-600">Title</p>
                        <input type="text" name="title" class="w-full border-gray-200 rounded-lg">
                        @error('title')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-1 w-full">
                        <p class="text-sm text-gray-600">Client</p>
                        <div class="relative">
                            <input type="text" id="selected-client-name" value="Select a Client" class="w-full border-gray-200 rounded-lg cursor-pointer" readonly onclick="openModal()">
                            <input type="hidden" name="client_id" id="selected-client-id">
                        </div>
                        @error('client_id')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-full">
                        <p class="text-sm text-gray-600">Content Writer</p>
                        <select name="content_writer_id" class="w-full border-gray-200 rounded-lg text-sm ">
                            <option value="" disabled selected>Select A Content Writer</option>
                            @foreach ($content_writers as $content_writer)
                                <option value="{{ $content_writer->id }}" class="text-black text-sm">{{ $content_writer->name }}</option>
                            @endforeach
                        </select>
                        @error('content_writer_id')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    

                    <div class="w-full">
                        <p class="text-sm text-gray-600">Graphics Designer</p>
                        <select name="graphic_designer_id" class="w-full border-gray-200 rounded-lg text-sm ">
                            <option value="" disabled selected>Select A Graphic Designer</option>
                            @foreach ($graphic_designers as $graphic_designer)
                                <option value="{{ $graphic_designer->id }}">{{ $graphic_designer->name }}</option>
                            @endforeach
                        </select>
                        @error('graphic_designer_id')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2 grid grid-cols-2 w-full gap-4 rounded-lg">
                        <div>
                            <p class="text-sm text-gray-600">Date Started</p>
                            <input type="date" name="date_started" class="w-full rounded-lg border-gray-200 focus:ring-0">
                            @error('date_started')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Date Deadline</p>
                            <input type="date" name="date_target" class="w-full rounded-lg border-gray-200 focus:ring-0">
                            @error('date_target')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-span-2 h-fit w-full">
                        <p class="text-sm text-gray-600">Description</p>
                        
                        <!-- CKEditor Textarea -->
                        <textarea name="description" id="editor" class="w-full border-gray-200 rounded-lg"></textarea>
                        <input type="hidden" name="request_id" value="{{$supervisor_request->id}}">
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

    <!-- Modal -->
    <div id="client-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-lg font-semibold mb-4">Select a Client</h2>
            <ul class="max-h-60 overflow-y-auto">
                @foreach($clients as $client)
                <li class="p-2 border-b cursor-pointer hover:bg-gray-100" onclick="selectClient('{{ $client->id }}', '{{ $client->name }}')">
                    {{ $client->name }}
                </li>
                @endforeach
            </ul>
            <button onclick="closeModal()" class="mt-4 bg-[#fa7011] text-white px-4 py-2 rounded">Close</button>
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

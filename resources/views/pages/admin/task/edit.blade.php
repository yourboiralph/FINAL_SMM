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
</style>

<!-- CKEditor 5 CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<div class="container mx-auto p-6">
    <div class="w-full px-6 py-10 mx-auto rounded-lg custom-shadow">
        <div>
            <a href="{{ url('/operation/task') }}">
                <div class="w-fit px-4 py-1 bg-[#fa7011] rounded-md text-white custom-shadow custom-hover-shadow">
                    Back
                </div>
            </a>
        </div>
        <form action="{{ url('operation/task/update/' . $job_draft->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h1 class="text-xl font-bold mt-4">Create Draft</h1>
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
                    <!-- Graphics Designer -->
                    <div class="col-span-1 w-full">
                        <p class="text-sm text-gray-600">Graphics Designer</p>
                        <div class="relative">
                            <input type="text" id="selected-graphic-designer-name"
                                value="{{ old('graphic_designer_id') ? ($graphic_designers->firstWhere('id', old('graphic_designer_id'))->name ?? 'Select a Graphics Designer') : 'Select a Graphics Designer' }}"
                                class="w-full border-gray-200 rounded-lg cursor-pointer" readonly
                                onclick="openGraphicDesignerModal()">
                            <input type="hidden" name="graphic_designer_id" id="selected-graphic-designer-id"
                                value="{{ old('graphic_designer_id', $job_draft->graphicDesigner->id ?? '') }}">
                        </div>
                        @error('graphic_designer_id')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    @elseif ($job_draft->type === 'content_writer')
                        <div class="col-span-1 w-full">
                            <p class="text-sm text-gray-600">Content Writer</p>
                            <div class="relative">
                                <input type="text" id="selected-content-writer-name"
                                    value="{{ old('content_writer_id') ? ($content_writers->firstWhere('id', old('content_writer_id'))->name ?? 'Select a Content Writer') : ($job_draft->contentWriter->name ?? 'Select a Content Writer') }}"
                                    class="w-full border-gray-200 rounded-lg cursor-pointer" readonly
                                    onclick="openContentWriterModal()">
                                <input type="hidden" name="content_writer_id" id="selected-content-writer-id"
                                    value="{{ old('content_writer_id', $job_draft->contentWriter->id ?? '') }}">
                            </div>
                            @error('content_writer_id')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    
                    @endif

                    <!-- Client -->
                    <div class="col-span-1 w-full">
                        <p class="text-sm text-gray-600">Client</p>
                        <div class="relative">
                            <input type="text" id="selected-client-name"
                            value="{{ old('client_id') ? ($job_draft->client->firstWhere('id', old('client_id'))->name ?? 'Select a Client') : ($job_draft->client->name ?? 'Select a Client') }}"
                            class="w-full border-gray-200 rounded-lg cursor-pointer" readonly onclick="openModal()">
                            <input type="hidden"name="client_id" id="selected-client-id" value="{{ old('client_id', $job_draft->client->id ?? '') }}">
                        </div>
                        @error('client_id')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>


    
                    <div class="col-span-1 grid grid-cols-2 w-full gap-4 rounded-lg">
                        <div>
                            <p class="text-sm text-gray-600">Date Started</p>
                            <input type="date" name="date_started" class="w-full rounded-lg border-gray-200" value="{{ old('date_started', \Carbon\Carbon::parse($job_draft->date_started)->format('Y-m-d')) }}">
                            @error('date_started')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 text-nowrap">Date Deadline</p>
                            <input type="date" name="date_target" class="w-full rounded-lg border-gray-200" value="{{ old('date_target', \Carbon\Carbon::parse($job_draft->date_target)->format('Y-m-d')) }}">
                            @error('date_target')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-span-2 h-fit w-full">
                        <p class="text-sm text-gray-600">Description</p>
                        
                        <!-- CKEditor Textarea -->
                        <textarea name="description" id="editor" class="w-full border-gray-200 rounded-lg"></textarea>
                    
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
    function filterTable() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let tableBody = document.getElementById("tableBody");
        let rows = tableBody.getElementsByTagName("tr");

        for (let row of rows) {
            let title = row.getElementsByTagName("td")[0]?.textContent.toLowerCase();
            let assignedBy = row.getElementsByTagName("td")[1]?.textContent.toLowerCase();

            if (title.includes(input) || assignedBy.includes(input)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        }
    }

    // Open Content Writer Modal
    function openContentWriterModal() {
        document.getElementById('content-writer-modal').classList.remove('hidden');
    }

    // Close Content Writer Modal
    function closeContentWriterModal() {
        document.getElementById('content-writer-modal').classList.add('hidden');
    }

    // Select a Content Writer
    function selectContentWriter(contentWriterId, contentWriterName) {
        document.getElementById('selected-content-writer-name').value = contentWriterName;
        document.getElementById('selected-content-writer-id').value = contentWriterId;
        closeContentWriterModal();
    }

    // Filter Content Writer Table
    function filterContentWriterTable() {
        let input = document.getElementById("searchContentWriterInput").value.toLowerCase();
        let tableBody = document.getElementById("contentWriterTableBody");
        let rows = tableBody.getElementsByTagName("tr");

        for (let row of rows) {
            let name = row.getElementsByTagName("td")[0]?.textContent.toLowerCase();
            let role = row.getElementsByTagName("td")[1]?.textContent.toLowerCase();

            if (name.includes(input) || role.includes(input)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        }
    }

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

    // Open Graphics Designer Modal
    function openGraphicDesignerModal() {
        document.getElementById('graphic-designer-modal').classList.remove('hidden');
    }

    // Close Graphics Designer Modal
    function closeGraphicDesignerModal() {
        document.getElementById('graphic-designer-modal').classList.add('hidden');
    }

    // Select a Graphics Designer
    function selectGraphicDesigner(graphicDesignerId, graphicDesignerName) {
        document.getElementById('selected-graphic-designer-name').value = graphicDesignerName;
        document.getElementById('selected-graphic-designer-id').value = graphicDesignerId;
        closeGraphicDesignerModal();
    }

    // Filter Graphics Designer Table
    function filterGraphicDesignerTable() {
        let input = document.getElementById("searchGraphicDesignerInput").value.toLowerCase();
        let tableBody = document.getElementById("graphicDesignerTableBody");
        let rows = tableBody.getElementsByTagName("tr");

        for (let row of rows) {
            let name = row.getElementsByTagName("td")[0]?.textContent.toLowerCase();
            let role = row.getElementsByTagName("td")[1]?.textContent.toLowerCase();

            if (name.includes(input) || role.includes(input)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        }
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


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
        <form action="{{ url('/supervisor/joborder/update/' . $supervisor_request->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h1 class="text-xl font-bold mt-4">Edit Form</h1>
            <div class="grid grid-cols-4 space-y-4">
                <div class="col-span-4 grid grid-cols-2 gap-4 mt-4">
                    <div class="w-full">
                        <p class="text-sm text-gray-600">Title</p>
                        <input type="text" name="title" class="w-full border-gray-200 rounded-lg" value="{{ old('title', $supervisor_request->title) }}">
                        @error('title')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Operator Selection Modal Trigger -->
                    <div class="col-span-1 w-full">
                        <p class="text-sm text-gray-600">Operator</p>
                        <div class="relative">
                            <input type="text" id="selected-operator-name" 
                                value="{{ old('assigned_to') ? ($operators->firstWhere('id', old('assigned_to'))->name ?? 'Select an Operator') : 'Select an Operator' }}" 
                                class="w-full border-gray-200 rounded-lg cursor-pointer" readonly 
                                onclick="openOperatorModal()">
                            <input type="hidden" name="assigned_to" id="selected-operator-id" 
                                value="{{ old('assigned_to', $supervisor_request->assignee->name) }}">
                        </div>
                        @error('assigned_to')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                
                    
                    <div class="col-span-2 h-fit w-full">
                        <p class="text-sm text-gray-600">Description</p>
                        
                        <!-- CKEditor Textarea -->
                        <textarea name="description" id="editor" class="w-full border-gray-200 rounded-lg">{{ old('description', $supervisor_request->description) }}</textarea>
                    
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
    <!-- Operator Selection Modal -->
<div id="operator-modal" class="fixed inset-0 bg-gray-900 px-20 z-50 bg-opacity-50 flex flex-col items-center justify-center hidden">
    <div class="bg-white w-full px-5 pb-10 pt-5 rounded-lg">
        <div class="w-full h-fit flex flex-col md:flex-row justify-between items-center gap-4 mb-4">
            <input type="text" id="searchOperatorInput" class="w-full md:w-80 px-10 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Search..." onkeyup="filterOperatorTable()">
            <button onclick="closeOperatorModal()" class=" bg-[#fa7011] text-white px-4 py-2 rounded">Close</button>
        </div>
        <div class="overflow-x-auto overflow-y-auto w-full bg-white shadow-md rounded-lg h-[500px]" style="max-height: 500px;">
            <table class="w-full text-left border-collapse min-w-[500px]">
                <thead class="sticky top-0 bg-[#fa7011] text-white">
                    <tr>
                        <th class="px-6 py-3 w-32">Name</th>
                        <th class="px-6 py-3 w-32">Role</th>
                        <th class="px-6 py-3 w-32 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="operatorTableBody">
                    @foreach ($operators as $operator)
                        <tr class="border-b">
                            <td class="px-6 py-3">{{ $operator->name }}</td>
                            <td class="px-6 py-3">{{ ucfirst($operator->role->position) }}</td>
                            <td class="px-6 py-3 text-center">
                                <button onclick="selectOperator('{{ $operator->id }}', '{{ $operator->name }}')" class="px-2 py-1 mb-2 lg:mb-0 lg:px-4 lg:py-2 text-sm text-white bg-orange-500 rounded hover:bg-orange-600">
                                    Select
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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

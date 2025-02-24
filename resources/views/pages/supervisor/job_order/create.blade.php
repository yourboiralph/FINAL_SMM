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
    <div class="w-full px-6 py-10 mx-auto rounded-lg custom-shadow bg-white">
        <div>
            <a href="{{ url('/supervisor/joborder') }}">
                <div class="w-fit px-4 py-1 bg-gray-400 rounded-md text-white custom-shadow custom-hover-shadow">
                    Back
                </div>
            </a>
        </div>
        <form action="{{ url('/supervisor/joborder/store') }}" method="POST">
            @csrf

            <h1 class="text-xl font-bold mt-4">Create Job Order</h1>
            <div class="grid grid-cols-4 space-y-4">
                <div class="col-span-4 grid grid-cols-2 gap-4 mt-4">
                    <!-- Title Input -->
                    <div class="col-span-2 lg:col-span-1 w-full">
                        <p class="text-sm text-gray-600">Title</p>
                        <input type="text" name="title" value="{{ old('title') }}" class="w-full border-gray-200 rounded-lg">
                        @error('title')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Operator Selection Modal Trigger -->
                    <div class="col-span-2 lg:col-span-1 w-full">
                        <p class="text-sm text-gray-600">Operator</p>
                        <div class="relative">
                            <input type="text" id="selected-operator-name"
                                value="{{ old('assigned_to') ? ($operators->firstWhere('id', old('assigned_to'))->name ?? 'Select an Operator') : 'Select an Operator' }}"
                                class="w-full border-gray-200 rounded-lg cursor-pointer" readonly
                                onclick="openOperatorModal()">
                            <input type="hidden" name="assigned_to" id="selected-operator-id"
                                value="{{ old('assigned_to') }}">
                        </div>
                        @error('assigned_to')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description CKEditor Textarea -->
                    <div class="col-span-2 h-fit w-full">
                        <p class="text-sm text-gray-600">Instructions</p>
                        <textarea name="description" id="editor" class="w-full border-gray-200 rounded-lg">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="col-span-1 text-center py-2 lg:py-4 w-full bg-[#fa7011] mt-10 rounded-lg custom-shadow custom-hover-shadow text-white font-bold">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Operator Selection Modal -->
<div id="operator-modal" class="fixed inset-0 bg-gray-900 px-4 md:px-20 z-50 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white w-full max-w-sm md:max-w-lg lg:max-w-2xl px-5 pb-10 pt-5 rounded-lg">
        <!-- Search & Close button -->
        <div class="w-full flex md:flex-row justify-between items-center flex-col-reverse lg:flex-row gap-4 mb-4">
            <input type="text" id="searchOperatorInput" class="w-full md:w-80 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Search..." onkeyup="filterOperatorTable()">
            <div class="w-full flex justify-end md:w-auto">
                <button onclick="closeOperatorModal()" class="bg-[#fa7011] text-white px-4 py-2 rounded w-fit">Close</button>
            </div>
        </div>


        <!-- Table Container -->
        <div class="overflow-x-auto w-full bg-white shadow-md rounded-lg max-h-[500px]">
            <table class="w-full text-left border-collapse min-w-[300px] md:min-w-[500px]">
                <thead class="sticky top-0 bg-[#fa7011] text-white">
                    <tr>
                        <th class="px-4 md:px-6 py-3 w-24 md:w-32">Name</th>
                        <th class="px-4 md:px-6 py-3 w-24 md:w-32">Role</th>
                        <th class="px-4 md:px-6 py-3 w-24 md:w-32 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="operatorTableBody">
                    @forelse ($operators as $operator)
                        <tr class="border-b">
                            <td class="px-4 md:px-6 py-3">{{ $operator->name }}</td>
                            <td class="px-4 md:px-6 py-3">{{ ucfirst($operator->role->position) }}</td>
                            <td class="px-4 md:px-6 py-3 text-center">
                                <button onclick="selectOperator('{{ $operator->id }}', '{{ $operator->name }}')" class="px-2 py-1 md:px-4 md:py-2 text-sm text-white bg-orange-500 rounded hover:bg-orange-600 w-full md:w-auto">
                                    Select
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr class="h-[400px]">
                            <td colspan="3" class="px-6 py-3">
                                <div class="flex h-full items-center justify-center">
                                    <i class="far fa-grin-beam-sweat"></i>
                                    No Data Found
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    function openOperatorModal() {
        document.getElementById('operator-modal').classList.remove('hidden');
    }

    function closeOperatorModal() {
        document.getElementById('operator-modal').classList.add('hidden');
    }

    function selectOperator(operatorId, operatorName) {
        document.getElementById('selected-operator-name').value = operatorName;
        document.getElementById('selected-operator-id').value = operatorId;
        closeOperatorModal();
    }

    function filterOperatorTable() {
        let input = document.getElementById("searchOperatorInput").value.toLowerCase();
        let tableBody = document.getElementById("operatorTableBody");
        let rows = tableBody.getElementsByTagName("tr");

        for (let row of rows) {
            let name = row.getElementsByTagName("td")[0]?.textContent.toLowerCase();
            if (name.includes(input)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        }
    }

    ClassicEditor.create(document.querySelector('#editor'))
        .then(editor => console.log('CKEditor initialized'))
        .catch(error => console.error(error));
</script>

@endsection

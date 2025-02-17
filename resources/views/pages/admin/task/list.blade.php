@extends('layouts.application')

@section('title', 'Admin')
@section('header', "My Task") 

@section('content')

<div class="container mx-auto p-6">

    {{-- Search Bar --}}
    <a href="{{ url('joborder/create') }}">
        <div class="bg-[#fa7011] w-fit block text-white px-4 py-2 rounded-lg shadow-md hover:bg-cyan-800 transition text-center lg:hidden">
            <i class="fa-solid fa-plus"></i>
        </div>
    </a>
    <div class="w-full h-fit flex flex-col md:flex-row justify-between items-center gap-4 mb-4 mt-4">
        {{-- <a href="{{ url('joborder/create') }}">
            <div class="bg-[#fa7011] hidden text-white px-4 py-2 rounded-lg shadow-md hover:bg-cyan-800 transition text-center w-full md:w-auto lg:block">
                Create New Job Order
            </div>
        </a> --}}

        
        <div class="flex items-center w-full md:w-auto relative">
            <i class="fa-solid fa-magnifying-glass absolute left-4 text-gray-500"></i>
            <input type="text" id="searchInput" class="w-full md:w-80 px-10 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" 
            placeholder="Search..." onkeyup="filterTable()" />
            <button class="absolute right-2 px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">
                <i class="fa-solid fa-filter"></i>
            </button>
        </div>
    </div>

    {{-- Table Wrapper --}}
    <div class="overflow-x-auto overflow-y-auto bg-white shadow-md rounded-lg h-[500px]" style="max-height: 500px;">
        <table class="w-full text-left border-collapse min-w-[500px]">
            <thead class="sticky top-0 bg-[#fa7011] text-white">
                <tr>
                    <th class="px-6 py-3">Title</th>
                    <th class="px-6 py-3">Designated</th>
                    <th class="text-right px-6">Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody" class="overflow-y-auto">
                @foreach ($job_drafts as $job_draft)
                    <tr class="border-b">
                        <td class="px-6 py-3">{{ $job_draft->jobOrder->title }}</td>
                        <td class="px-6 py-3">
                            @if ($job_draft->type == "content_writer")
                                Content Writer - {{ $job_draft->contentWriter->name }}
                            @else
                                Graphic Designer - {{ $job_draft->graphicDesigner->name }}
                            @endif
                        </td>
                        <td class="px-6 py-3 text-right">
                            <a href="{{url('operation/task/edit/' . $job_draft->id)}}">
                                <button class="px-2 py-1 mb-2 lg:mb-0 lg:px-4 lg:py-2 text-sm text-white bg-orange-500 rounded hover:bg-orange-600">
                                    Edit
                                </button>
                            </a>
                            <a href="{{url('operation/task/edit/' . $job_draft->id)}}">
                                <button class="px-2 py-1 lg:px-4 lg:py-2 text-sm text-white bg-gray-700 rounded hover:bg-gray-800">
                                    Show
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination Links --}}
    <div class="mt-4">
        {{-- {{ $list_of_projects->links('vendor.pagination.custom') }} --}}
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
</script>

@endsection

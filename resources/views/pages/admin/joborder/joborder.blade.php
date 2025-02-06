@extends('layouts.application')

@section('title', 'Page Title')
@section('header', "Job Order") 

@section('content')

<div class="container mx-auto p-6">

    {{-- Search Bar --}}
    <div class="w-full h-fit flex justify-between ">
        <a href="{{ url('joborder/create') }}">
            <div class="bg-[#fa7011] text-white px-4 py-2 rounded-lg shadow-md hover:bg-cyan-800 transition">

                Create New Job Order

            </div>
        </a>
        <div class="flex items-center mb-4 relative w-fit">
            <i class="fa-solid fa-magnifying-glass absolute pl-4"></i>
            <button class="absolute right-2 px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">
                <i class="fa-solid fa-filter"></i>
            </button>
            <input type="text" id="searchInput"
                class="px-10 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                placeholder="Search..." />
        </div>
    </div>
 {{$job_drafts[0]->jobOrder->title}}
    {{-- Table Wrapper --}}
    <div class="h-96 overflow-auto">
        <table class="w-full text-left border-collapse" id="projectTable">
            <thead class="sticky top-0 bg-[#fa7011] text-white">
                <tr>
                    <th class="px-6 py-3">File Name</th>
                    <th>Designated</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach ($job_drafts as $job_draft)
                    <tr class="project-row">
                        <td class="px-6 py-3 border-b">{{ $job_draft->jobOrder->title }}</td>
                        @if ($job_draft->type == "content_writer")
                            <td class="px-6 py-3 border-b">Content Writer - {{ $job_draft->contentWriter->name }}</td>
                        @else
                            <td class="px-6 py-3 border-b">Graphic Designer - {{ $job_draft->graphicDesigner->name }}</td>
                        @endif

                        
                        <td class="px-6 py-3 border-b text-right">
                            <a href="{{url('joborder/edit/' . $job_draft->id)}}">
                                <button class="px-4 py-2 text-sm text-white bg-orange-500 rounded hover:bg-orange-600">
                                    Edit
                                </button>
                            </a>
                            <a href="{{url('joborder/show/' . $job_draft->id)}}">

                                <button class="px-4 py-2 text-sm text-white bg-gray-700 rounded hover:bg-gray-800">
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
@endsection
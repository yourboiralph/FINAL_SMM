@extends('layouts.application')

@section('title', 'Job Order')
@section('header', 'List of Job Orders')

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

<div class="container mx-auto p-6">
    <div class="h-[500px] max-h-[500px] overflow-auto bg-white shadow-md rounded-lg">
        {{-- Success Message Component --}}
        @if(session('Status'))
            <x-success />
        @endif

        <table class="w-full table-fixed text-left border-collapse min-w-[600px]" id="projectTable">
            <thead class="sticky top-0 bg-[#fa7011] text-white">
                <tr>
                    <th class="w-[30%] px-4 py-3">Title</th>
                    <th class="w-[30%] px-4 py-3">Designated</th>
                    <th class="w-[20%] px-4 py-3">Deadline</th>
                    <th class="w-[20%] px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse ($job_drafts as $job_draft)
                    <tr class="project-row border-b">
                        <td class="w-[30%] px-4 py-3 truncate">{{ $job_draft->jobOrder->title }}</td>
                        <td class="w-[30%] px-4 py-3 truncate">
                            @if ($job_draft->type == "content_writer")
                                Content Writer - {{ $job_draft->contentWriter->name }}
                            @else
                                Graphic Designer - {{ $job_draft->graphicDesigner->name }}
                            @endif
                        </td>
                        <td class="w-[20%] px-4 py-3 whitespace-nowrap">
                            {{ $job_draft->date_target }}
                        </td>
                        <td class="w-[20%] px-4 py-3 text-center border-b">
                            <a href="{{ url('content/edit/' . $job_draft->id) }}">
                                <button class="px-2 py-1 lg:px-4 lg:py-2 text-sm text-white bg-green-500 rounded hover:bg-green-600">
                                    Create
                                </button>
                            </a>
                            <a href="{{ url('content/show/' . $job_draft->id) }}">
                                <button class="px-2 py-1 lg:px-4 lg:py-2 text-sm text-white bg-gray-700 rounded hover:bg-gray-800">
                                    Show
                                </button>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr class="h-[400px]">
                        <td colspan="4" class="px-6 py-3">
                            <div class="flex h-full items-center flex-col justify-center space-y-4">
                                <i class="far fa-grin-beam-sweat text-7xl" style="color: #fa7011;"></i>
                                <p class="text-[#fa7011]">No Data Found</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


@endsection

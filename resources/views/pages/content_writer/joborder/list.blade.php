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
    <div class="h-[500px] max-h-[500px] overflow-auto bg-white">
                {{-- Success Message Component --}}
                @if(session('Status'))
                <x-success />
            @endif
        <table class="w-full text-left border-collapse" id="projectTable">
            <thead class="sticky top-0 bg-[#fa7011] text-white">
                <tr>
                    <th class="px-6 py-3">Title</th>
                    <th class="px-6 py-3">Designated</th>
                    <th class="px-6 py-3">Deadline</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse ($job_drafts as $job_draft)
                    <tr class="project-row border-b">
                        <td class="px-6 py-3">{{ $job_draft->jobOrder->title }}</td>
                        @if ($job_draft->type == "content_writer")
                            <td class="px-6 py-3">Content Writer - {{ $job_draft->contentWriter->name }}</td>
                        @else
                            <td class="px-6 py-3">Graphic Designer - {{ $job_draft->graphicDesigner->name }}</td>
                        @endif
                        <td class="px-6 py-3">
                            {{$job_draft->date_target}}
                        </td>


                        <td class="px-6 py-3 border-b">
                            <a href="{{url('content/edit/' . $job_draft->id)}}">
                                <button class="px-2 py-1 mb-2 lg:mb-0 lg:px-4 lg:py-2 text-sm text-white bg-orange-500 rounded hover:bg-orange-600">
                                    Create
                                </button>
                            </a>
                            <a href="{{url('content/show/' . $job_draft->id)}}">

                                <button class="px-2 py-1 lg:px-4 lg:py-2 text-sm text-white bg-gray-700 rounded hover:bg-gray-800">
                                    Show
                                </button>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr class="h-[400px]">
                        <td colspan="3" class="px-6 py-3">
                            <div class="flex h-full items-center justify-center">
                                No Data Available
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
@extends('layouts.application')

@section('title', 'Clients')
@section('header', 'Download PDF')

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

<div class="container mx-auto p-4 sm:p-6">
    <div class="overflow-x-auto h-[500px] max-h-[500px] overflow-y-auto bg-white shadow-md rounded-lg">
                {{-- Success Message Component --}}
                @if(session('Status'))
                <x-success />
            @endif
        <table class="w-full text-left border-collapse min-w-full sm:min-w-max" id="projectTable">
            <thead class="sticky top-0 bg-[#fa7011] text-white">
                <tr>
                    <th class="px-2 sm:px-4 py-2 text-center md:text-left text-nowrap sm:py-3 text-xs sm:text-base">Title</th>
                    <th class="px-2 sm:px-4 py-2 text-center md:text-left text-nowrap sm:py-3 text-xs sm:text-base">Designated</th>
                    <th class="px-2 sm:px-4 py-2 text-center md:text-left text-nowrap sm:py-3 text-xs sm:text-base">Deadline</th>
                    <th class="px-2 sm:px-4 py-2 text-center md:text-left text-nowrap sm:py-3 text-xs sm:text-base">Status</th>
                    <th class="px-2 sm:px-4 py-2 text-center md:text-left text-nowrap sm:py-3 text-xs sm:text-base">Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach ($job_drafts as $job_draft)
                    <tr class="project-row border-b text-xs sm:text-sm">
                        <td class="px-2 sm:px-4 py-2 sm:py-3">{{ $job_draft->jobOrder->title }}</td>
                        @if ($job_draft->type == "content_writer")
                            <td class="px-2 sm:px-4 py-2 sm:py-3">Content Writer - {{ $job_draft->contentWriter->name }}</td>
                        @else
                            <td class="px-2 sm:px-4 py-2 sm:py-3">Graphic Designer - {{ $job_draft->graphicDesigner->name }}</td>
                        @endif
                        <td class="px-2 sm:px-4 py-2 sm:py-3 whitespace-nowrap">{{$job_draft->date_target}}</td>
                        <td class="px-2 sm:px-4 py-2 sm:py-3">{{$job_draft->status}}</td>
                        <td class="px-2 sm:px-4 py-2 sm:py-3 border-b">
                            <a href="{{ route('client.history.download', $job_draft->id) }}">
                                <button class="px-2 sm:px-3 py-1 sm:py-2 text-xs sm:text-sm text-white bg-orange-500 rounded hover:bg-orange-600 whitespace-nowrap">
                                    Download PDF
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
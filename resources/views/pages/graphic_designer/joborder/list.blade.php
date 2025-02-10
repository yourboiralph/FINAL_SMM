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
    <div class="h-96 overflow-auto">
        <table class="w-full text-left border-collapse" id="projectTable">
            <thead class="sticky top-0 bg-[#fa7011] text-white">
                <tr>
                    <th class="px-6 py-3">File Name</th>
                    <th class="px-6 py-3">Designated</th>
                    <th class="px-6 py-3">Deadline</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach ($job_drafts as $job_draft)
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
                            <a href="{{url('graphic/edit/' . $job_draft->id)}}">
                                <button class="px-4 py-2 text-sm text-white bg-orange-500 rounded hover:bg-orange-600">
                                    Create draft
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
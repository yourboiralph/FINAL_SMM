@extends('layouts.application')

@section('title', 'Job Order')
@section('header', 'Job Order Approvals')

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
    <div class="overflow-x-auto overflow-y-auto bg-white shadow-md rounded-lg h-[500px] max-h-[500px]">
        {{-- Success Message Component --}}
        @if(session('Status'))
            <x-success />
        @endif

        <table class="w-full table-fixed text-left border-collapse min-w-[600px]" id="projectTable">
            <thead class="sticky top-0 bg-[#fa7011] text-white">
                <tr>
                    <th class="w-[60%] px-4 py-3 text-xs sm:text-base">Title</th>
                    <th class="w-[20%] px-4 py-3 text-center text-xs sm:text-base">Status</th>
                    <th class="w-[20%] px-4 py-3 text-center text-xs sm:text-base">Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse ($job_drafts as $job_draft)
                    <tr class="project-row border-b text-xs sm:text-sm">
                        <td class="w-[60%] px-4 py-3 truncate">{{ $job_draft->jobOrder->title }}</td>
                        <td class="w-[20%] px-4 py-3 text-center text-white">
                            <p class="w-full px-2 py-1 rounded-lg text-wrap
                                {{ $job_draft->status == 'completed' ? 'bg-green-400' : 
                                ($job_draft->status == 'Revision' ? 'bg-red-600' : 'bg-[#fa6e117e]') }} ">
                                {{ ucfirst($job_draft->status) }}
                            </p>
                        </td>
                        <td class="w-[20%] px-4 py-3 text-center border-b">
                            <a href="{{ url('supervisor/approve/show/' . $job_draft->id) }}">
                                <button class="px-2 sm:px-3 py-1 sm:py-2 text-xs sm:text-sm text-white bg-orange-500 rounded hover:bg-orange-600 whitespace-nowrap">
                                    View Form
                                </button>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr class="h-[400px]">
                        <td colspan="3" class="px-6 py-3">
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

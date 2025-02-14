@extends('layouts.application')

@section('title', 'Job Order')
@section('header', 'Job Order')

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

    canvas {
        border: 2px solid #000;
        background-color: #fff;
    }
</style>

<!-- Include CKEditor 5 CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<div class="mx-auto max-w-screen-2xl">
    <div class="h-full mx-auto max-w-screen-xl">
        {{-- Middle Part --}}
        <div class="">
            <div class="">
                <div class="h-auto gap-8 m-10 p-10 relative bg-white"
                     style="box-shadow: 0 20px 30px -5px rgba(0, 0, 0, 0.3); border-radius: 8px;">
                     
                    <!-- Back Button -->
                    <div class="rounded-md text-white flex justify-end mb-10">
                        <a href="{{ url('/operation') }}"
                           class="w-fit px-4 py-1 bg-[#fa7011] rounded hover:bg-[#d95f0a] transition duration-200">
                            Back
                        </a>
                    </div>
                    
                    <!-- Job Order Details using a Table Layout -->
                    <table class="w-full table-fixed border-collapse border-none">
                        <colgroup>
                            <col style="width: 20%;">
                            <col style="width: 80%;">
                        </colgroup>
                        <tbody>
                            <tr class="align-top">
                                <td class="px-4 py-2 font-semibold">Project Name:</td>
                                <td class="px-4 py-2">{{ $job_draft->jobOrder->title }}</td>
                            </tr>
                            <tr class="align-top">
                                <td class="px-4 py-2 font-semibold">Designation:</td>
                                <td class="px-4 py-2">{{ $job_draft->type }}</td>
                            </tr>
                            <tr class="align-top">
                                <td class="px-4 py-2 font-semibold">Google Drive Link:</td>
                                <td class="px-4 py-2">
                                    <div class="min-h-[300px] max-h-[500px] overflow-y-auto break-all">
                                        {!! $job_draft->draft !!}
                                    </div>
                                </td>
                            </tr>
                            <tr class="align-top">
                                <td class="px-4 py-2 font-semibold">Date:</td>
                                <td class="px-4 py-2">{{ $job_draft->date_target }}</td>
                            </tr>
                            <tr class="align-top">
                                <td class="px-4 py-2 font-semibold">Client Name:</td>
                                <td class="px-4 py-2">{{ $job_draft->client->name }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Decline Form Section -->
                    <div class="mt-10">
                        <form action="{{ url('/supervisor/approve/decline/' . $job_draft->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <!-- CKEditor 5 for Decline Reason -->
                            <label for="summary" class="block font-semibold">Decline Reason:</label>
                            <textarea class="w-full border p-2 rounded-md" name="summary" id="summaryEditor"></textarea>

                            <button type="submit"
                                    class="px-4 py-2 mt-4 text-sm text-white bg-red-500 rounded hover:bg-red-600 disabled:opacity-50 disabled:cursor-not-allowed"
                                    id="declineBtn">
                                Decline
                            </button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Initialize CKEditor 5 -->
<script>
    ClassicEditor
        .create(document.querySelector('#summaryEditor'))
        .catch(error => {
            console.error(error);
        });
</script>

@endsection

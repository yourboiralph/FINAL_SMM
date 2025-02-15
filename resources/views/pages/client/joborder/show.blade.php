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
        <div class="h-auto gap-8 m-10 p-10 relative bg-white" style="box-shadow: 0 20px 30px -5px rgba(0, 0, 0, 0.3); border-radius: 8px;">
            <div class="rounded-md text-white flex justify-end mb-10">
                <a href="{{ url('/operation') }}" class="w-fit px-4 py-1 bg-[#fa7011] rounded hover:bg-[#d95f0a] transition duration-200">
                    Back
                </a>
            </div>

            <table class="table-auto border-collapse border-none">
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
                        <!-- Using break-all to ensure long URLs wrap properly -->
                        <td class="px-4 py-2 max-h-[500px] overflow-y-auto break-all">
                            <div class="text-sm text-gray-600 w-full max-h-[500px] overflow-y-auto bg-white border border-gray-300 p-2 rounded">
                                
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

            <div class="mt-10">
                <form action="{{ url('/client/update/' . $job_draft->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label for="feedback" class="block font-semibold">Feedback:</label>
                    <textarea class="w-full border p-2 rounded-md" name="feedback" id="summaryEditor"></textarea>

                    <div class="mt-4 flex space-x-4">
                        <button type="submit"
                            class="px-4 py-2 text-sm text-white bg-[#fa7011] rounded hover:bg-[#c06b32] disabled:opacity-50 disabled:cursor-not-allowed">
                            Accept
                        </button>
                        <a href="{{ url('/client/decline/' . $job_draft->id) }}">
                            <button type="button"
                                class="px-4 py-2 text-sm text-white bg-red-500 rounded hover:bg-red-600 disabled:opacity-50 disabled:cursor-not-allowed">
                                Decline
                            </button>
                        </a>
                    </div>
                </form>
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

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

<!-- Signature Pad -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="mx-auto max-w-screen-2xl">
    <div class="h-full mx-auto max-w-screen-xl">
        {{-- Middle Part --}}
        <div class="">
            <div class="" >

                <div class="h-auto gap-8 m-10 p-10 relative bg-white " style="box-shadow: 0 20px 30px -5px rgba(0, 0, 0, 0.3); border-radius: 8px;">
                    <div class="rounded-md text-white flex justify-end mb-10">
                        <a href="{{ url('/operation') }}" class="w-fit px-4 py-1 bg-[#fa7011] rounded hover:bg-[#d95f0a] transition duration-200">
                            Back
                        </a>
                    </div>
                    
                    <div class="flex gap-8">
                        <div>
                            <ul class="space-y-4 font-semibold">
                                <li>Project Name:</li>
                                <li>Designation:</li>
                                <li>Google Drive Link:</li>
                                <li>Date:</li>
                                <li>Client Name:</li>
                            </ul>
                        </div>
                        <div>
                            <ul class="space-y-4">
                                <li>{{ $job_draft->jobOrder->title }}</li>
                                <li>{{$job_draft->type}}</li>
                                <li class="overflow-hidden text-ellipsis whitespace-nowrap">{!! $job_draft->draft !!}</li>
                                <li>{{ $job_draft->date_target }}</li>
                                <li>{{ $job_draft->client->name }}</li>
                            </ul>
    
                            @if(!$job_draft->signature_admin)
                                {{-- Signature Upload Section --}}
                                <div class="mt-6 bg-white p-4 rounded-md shadow-md">
                                    <div class="flex justify-between">
                                        <h1 class="text-sm font-semibold">Choose Signature Method:</h1>
                                        <div class="flex">
                                            <button id="useUpload" class="px-2 border">File Upload</button>
                                            <button id="usePad" class="px-2 border">Signature Pad</button>
                                        </div>
                                    </div>

                                    <form action="{{ url('/operation/update/' . $job_draft->id) }}" method="POST"
                                        enctype="multipart/form-data" id="approvalForm">
                                        @csrf
                                        @method('PUT')

                                        @php
                                            $isDisabled = $job_draft->status != "Submitted to Operations";
                                        @endphp

                                        {{-- File Upload (Default) --}}
                                        <div id="uploadSection">
                                            <input type="file" name="signature_admin" accept="image/*"
                                                class="mt-2 border p-2 rounded-md" id="signatureInput" {{ $isDisabled ? 'disabled' : '' }}>
                                            <div
                                                class="mt-4 w-52 h-32 border border-gray-300 rounded-md overflow-hidden flex items-center justify-center bg-gray-100">
                                                <img id="imagePreview" src="#" alt="Selected Image"
                                                    class="hidden w-full h-full object-cover">
                                            </div>
                                        </div>

                                        {{-- Signature Pad --}}
                                        <div id="padSection" class="hidden">
                                            <canvas id="signature-pad" width="400" height="200"></canvas>
                                            <div class="mt-2 flex">
                                                <button type="button" id="clearPad"
                                                    class="bg-gray-500 text-white px-2 py-1 rounded mr-2">Clear</button>
                                            </div>
                                            <input type="hidden" name="signature_pad" id="signaturePadData">
                                        </div>

                                        {{-- Checkbox for Agreement --}}
                                        <div class="mt-4 flex items-center space-x-2">
                                            <input type="checkbox" id="agree" required {{ $isDisabled ? 'disabled' : '' }}>
                                            <label for="agree">I agree to the terms and conditions.</label>
                                        </div>

                                        <!-- Approve and Decline Buttons Side by Side -->
                                        <div class="mt-4 flex space-x-4">
                                            <button type="submit"
                                                class="px-4 py-2 text-sm text-white bg-orange-500 rounded hover:bg-orange-600 disabled:opacity-50 disabled:cursor-not-allowed"
                                                id="submitBtn" {{ $isDisabled ? 'disabled' : '' }}>
                                                Submit Approval
                                            </button>

                                            <!-- Decline Button triggers modal -->
                                            <button type="button"
                                                class="px-4 py-2 text-sm text-white bg-red-500 rounded hover:bg-red-600 disabled:opacity-50 disabled:cursor-not-allowed"
                                                id="declineBtn" {{ $isDisabled ? 'disabled' : '' }}>
                                                Decline
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Decline Modal -->
<div id="declineModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <h2 class="text-lg font-semibold mb-4">Decline Job Order</h2>
        <p class="text-sm text-gray-600 mb-2">Please provide a reason for declining this job order:</p>
        
        <form action="{{ url('/operation/decline/' . $job_draft->id) }}" method="POST">
            @csrf
            @method('POST')

            <!-- Reason Textbox -->
            <textarea name="summary" id="declineReason" rows="3"
                class="w-full border p-2 rounded-md" placeholder="Enter your reason..." required></textarea>

            <!-- Buttons -->
            <div class="mt-4 flex justify-end space-x-2">
                <button type="button" id="closeModal"
                    class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Cancel</button>
                <button type="submit"
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Submit Decline</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for Modal -->
<script>
    document.getElementById("declineBtn").addEventListener("click", function () {
        document.getElementById("declineModal").classList.remove("hidden");
    });

    document.getElementById("closeModal").addEventListener("click", function () {
        document.getElementById("declineModal").classList.add("hidden");
    });
</script>

@endsection

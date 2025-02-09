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

                                            <a href="{{ url('/operation/decline/' . $job_draft->id) }}">
                                                <button type="button"
                                                    class="px-4 py-2 text-sm text-white bg-red-500 rounded hover:bg-red-600 disabled:opacity-50 disabled:cursor-not-allowed"
                                                    id="declineBtn" {{ $isDisabled ? 'disabled' : '' }}>
                                                    Decline
                                                </button>
                                            </a>
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

{{-- JS for Live Preview, Signature Pad, and Switching --}}
<script>
    var signaturePad = new SignaturePad(document.getElementById("signature-pad"));

    // Toggle between File Upload and Signature Pad
    document.getElementById("useUpload").addEventListener("click", function () {
        document.getElementById("uploadSection").classList.remove("hidden");
        document.getElementById("padSection").classList.add("hidden");
        document.getElementById("signaturePadData").value = "";
    });

    document.getElementById("usePad").addEventListener("click", function () {
        document.getElementById("uploadSection").classList.add("hidden");
        document.getElementById("padSection").classList.remove("hidden");
        document.getElementById("signatureInput").value = "";
    });

    // Clear Signature Pad
    document.getElementById("clearPad").addEventListener("click", function () {
        signaturePad.clear();
    });

    // Convert Signature Pad to Base64 and store it in hidden input before submitting
    document.getElementById("approvalForm").addEventListener("submit", function (event) {
        if (!document.getElementById("uploadSection").classList.contains("hidden")) {
            return; // Skip if file upload is selected
        }

        if (signaturePad.isEmpty()) {
            alert("Please sign before submitting.");
            event.preventDefault();
        } else {
            document.getElementById("signaturePadData").value = signaturePad.toDataURL("image/png");
        }
    });

    // Image Preview for File Upload
    document.getElementById('signatureInput').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            preview.classList.add('hidden');
        }
    });

    // Enable Submit Button only if checkbox is checked
    document.getElementById('agree').addEventListener('change', function () {
        document.getElementById('submitBtn').disabled = !this.checked;
    });
</script>
@endsection
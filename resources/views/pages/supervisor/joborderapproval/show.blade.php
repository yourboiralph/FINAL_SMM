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
        <div>
            <div>

                <div class="h-auto gap-8 m-4 lg:m-10 p-4 lg:p-10 relative bg-white" style="box-shadow: 0 20px 30px -5px rgba(0, 0, 0, 0.3); border-radius: 8px;">
                    <div class="rounded-md text-white flex justify-end mb-10">
                        <a href="{{ url('/supervisor/approve') }}"
                           class="w-fit px-4 py-1 bg-[#fa7011] rounded hover:bg-[#d95f0a] transition duration-200">
                            Back
                        </a>
                    </div>

                    <!-- Responsive Grid for Details -->
                    <div class="grid grid-cols-1 lg:grid-cols-5 gap-4">
                        <!-- Project Name -->
                        <div class="lg:col-span-1 font-semibold">Project Name:</div>
                        <div class="lg:col-span-4">{{ $job_draft->jobOrder->title }}</div>

                        <!-- Designation -->
                        <div class="lg:col-span-1 font-semibold">Designation:</div>
                        <div class="lg:col-span-4">{{ $job_draft->type }}</div>

                        <!-- Google Drive Link -->
                        <div class="lg:col-span-1 font-semibold">Google Drive Link:</div>
                        <div class="lg:col-span-4">
                            <div class="max-h-[300px] border border-gray-400 p-4 rounded-lg overflow-y-auto break-all">
                                {!! $job_draft->draft !!}
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="lg:col-span-1 font-semibold">Date:</div>
                        <div class="lg:col-span-4">{{ $job_draft->date_target }}</div>

                        <!-- Client Name -->
                        <div class="lg:col-span-1 font-semibold">Client Name:</div>
                        <div class="lg:col-span-4">{{ $job_draft->client->name }}</div>

                        <!-- Signature Upload Section (Full Width) -->
                        <div class="hidden lg:block lg:col-span-1"></div>
                        <div class="lg:col-span-4">
                            @php
                                $isDisabled = $job_draft->status != "Submitted to Supervisor";
                                $isSigned = !empty($job_draft->signature_supervisor);
                            @endphp
                            <div class="mt-6 bg-white p-4 rounded-md shadow-md w-fit">
                                <div class="flex">
                                    <h1 class="text-sm font-semibold">Choose Signature Method:</h1>
                                    <div class="flex">
                                        <button id="useUpload" class="px-2 border disabled:opacity-50 disabled:cursor-not-allowed" {{ $isSigned ? 'disabled' : '' }}>File Upload</button>
                                        <button id="usePad" class="px-2 border disabled:opacity-50 disabled:cursor-not-allowed" {{ $isSigned ? 'disabled' : '' }}>Signature Pad</button>
                                    </div>
                                </div>
            
                                <form action="{{ url('/supervisor/approve/update/' . $job_draft->id) }}" method="POST"
                                      enctype="multipart/form-data" id="approvalForm">
                                    @csrf
                                    @method('PUT')
            
                                    {{-- File Upload (Default) --}}
                                    <div id="uploadSection">
                                        <input type="file" name="signature_supervisor" accept="image/*"
                                               class="mt-2 border p-2 w-full rounded-md" id="signatureInput" {{ $isDisabled || $isSigned ? 'disabled' : '' }}>
                                        <div class="mt-4 w-52 h-32 border border-gray-300 rounded-md overflow-hidden flex items-center justify-center bg-gray-100">
                                            <img id="imagePreview" src="{{ $isSigned ? asset($job_draft->signature_supervisor) : '' }}"
                                                 alt="Selected Image" class="{{ $isSigned ? 'block' : 'hidden' }} w-full h-full object-cover">
                                        </div>
                                    </div>
            
                                    {{-- Signature Pad --}}
                                    <div id="padSection" class="hidden">
                                        <canvas id="signature-pad" class="w-[300px] lg:w-[400px]" height="200" {{ $isSigned ? 'style=pointer-events:none;opacity:0.5;' : '' }}></canvas>
                                        <div class="mt-2 flex">
                                            <button type="button" id="clearPad" class="bg-gray-500 text-white px-2 py-1 rounded mr-2" {{ $isSigned ? 'disabled' : '' }}>
                                                Clear
                                            </button>
                                        </div>
                                        <input type="hidden" name="signature_pad" id="signaturePadData" value="{{ old('signature_pad') }}">
                                    </div>

                                    @if($errors->has('signature_supervisor') || $errors->has('signature_pad'))
                                        <p class="text-sm text-red-600">
                                            {{ $errors->first('signature_supervisor') ?: $errors->first('signature_pad') }}
                                        </p>
                                    @endif
            
                                    {{-- Checkbox for Agreement --}}
                                    <div class="mt-4 flex items-center space-x-2">
                                        <input type="checkbox" id="agree" required {{ $isDisabled ? 'disabled' : '' }}>
                                        <label for="agree">I agree to the terms and conditions.</label>
                                    </div>
            
                                    {{-- Approve and Decline Buttons --}}
                                    <div class="mt-4 flex space-x-4">
                                        <button type="submit"
                                                class="px-4 py-2 text-sm text-white bg-orange-500 rounded hover:bg-orange-600 disabled:opacity-50 disabled:cursor-not-allowed"
                                                id="submitBtn" {{ $isDisabled || $isSigned ? 'disabled' : '' }}>
                                            Submit Approval
                                        </button>
            
                                        <a href="{{ url('/supervisor/approve/declineForm/' . $job_draft->id) }}">
                                            <button type="button"
                                                    class="px-4 py-2 text-sm text-white bg-red-500 rounded hover:bg-red-600 disabled:opacity-50 disabled:cursor-not-allowed"
                                                    id="declineBtn" {{ $isDisabled || $isSigned ? 'disabled' : '' }}>
                                                Decline
                                            </button>
                                        </a>
                                    </div>
            
                                </form>
                            </div>
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

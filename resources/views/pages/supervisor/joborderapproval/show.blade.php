@extends('layouts.application')

@section('title', 'Job Order')
@section('header', 'Job Order')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
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

    <!-- Signature Pad Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/signature_pad"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <div class="h-auto gap-8 m-4 lg:m-10 p-4 lg:p-10 relative bg-white"
        style="box-shadow: 0 20px 30px -5px rgba(0, 0, 0, 0.3); border-radius: 8px;">
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
            <div class="lg:col-span-4">{{ Str::title(str_replace('_', ' ', $job_draft->type)) }}</div>

            <!-- Google Drive Link -->
            <div class="lg:col-span-1 font-semibold">Google Drive Link:</div>
            <div class="lg:col-span-4">
                <div id="draftContent" class="max-h-[300px] rounded-lg overflow-y-auto break-all">
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
                @endphp
                <div class="mt-6 bg-white p-4 rounded-md shadow-md w-fit">
                    <div class="flex justify-between">
                        <h1 class="text-sm font-semibold">Choose Signature Method:</h1>
                        <div class="flex space-x-2">
                            <button id="useUpload"
                                class="px-2 border rounded {{ Auth::user()->signature ? '' : 'bg-gray-200' }}" {{ $isDisabled ? 'disabled' : '' }}>
                                <i class="fa-solid fa-file-arrow-up" style="color: #fa7011;"></i>
                            </button>
                            <button id="usePad" class="px-2 border rounded" {{ $isDisabled ? 'disabled' : '' }}>
                                <i class="fa-solid fa-file-signature" style="color: #fa7011;"></i>
                            </button>
                            <button id="useSavedSignature"
                                class="px-2 border rounded {{ Auth::user()->signature ? 'bg-gray-200' : '' }}" {{ $isDisabled ? 'disabled' : '' }}>
                                <i class="fa-solid fa-cloud-arrow-up" style="color: #fa7011;"></i>
                            </button>
                        </div>
                    </div>

                    <form action="{{ url('/supervisor/approve/update/' . $job_draft->id) }}" method="POST"
                        enctype="multipart/form-data" id="approvalForm">
                        @csrf
                        @method('PUT')

                        {{-- File Upload --}}
                        <div id="uploadSection" class="{{ Auth::user()->signature ? 'hidden' : '' }}">
                            <input type="file" name="signature_supervisor" accept="image/*"
                                class="mt-2 border p-2 w-full rounded-md" id="signatureInput" {{ $isDisabled || $isDisabled ? 'disabled' : '' }}>
                            <div
                                class="mt-4 w-52 h-32 border border-gray-300 rounded-md overflow-hidden flex items-center justify-center bg-gray-100">
                                <img id="imagePreview" src="{{ $isDisabled ? asset($job_draft->signature_supervisor) : '' }}"
                                    alt="Selected Image"
                                    class="{{ $isDisabled ? 'block' : 'hidden' }} w-full h-full object-cover">
                            </div>
                        </div>

                        {{-- Signature Pad --}}
                        <div id="padSection" class="hidden">
                            <canvas id="signature-pad" class="w-[300px] lg:w-[400px]"
                                style="height:200px; {{ $isDisabled ? 'pointer-events:none;opacity:0.5;' : '' }}"></canvas>
                            <div class="mt-2 flex">
                                <button type="button" id="clearPad" class="bg-gray-500 text-white px-2 py-1 rounded mr-2" {{ $isDisabled ? 'disabled' : '' }}>
                                    Clear
                                </button>
                            </div>
                            <input type="hidden" name="signature_pad" id="signaturePadData"
                                value="{{ old('signature_pad') }}">
                        </div>

                        {{-- Saved Signature Section --}}
                        <div id="savedPadSection" class="{{ Auth::user()->signature ? '' : 'hidden' }}">
                            <img id="new-signature-pad-main" class="w-[300px] lg:w-[400px]" style="height:200px;"
                                src="{{ asset(Auth::user()->signature) }}" alt="Your Saved Signature">
                            <div class="mt-2 flex">
                                <input type="hidden" name="new_signature_pad" id="savedSignatureData"
                                    value="{{ asset(Auth::user()->signature) }}">
                            </div>
                        </div>

                        @if($errors->has('signature_supervisor') || $errors->has('signature_pad'))
                            <p class="text-sm text-red-600">
                                {{ $errors->first('signature_supervisor') ?: $errors->first('signature_pad') }}
                            </p>
                        @endif

                        {{-- Agreement Checkbox --}}
                        <div class="mt-4 flex items-center space-x-2">
                            <input type="checkbox" id="agree" required {{ $isDisabled ? 'disabled' : '' }}>
                            <label for="agree">I agree to the terms and conditions.</label>
                        </div>

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p class="text-red-600">{{$error}}</p>
                            @endforeach
                        @endif

                        {{-- Approve and Decline Buttons --}}
                        <div class="mt-4 flex space-x-4">
                            <button type="submit"
                                class="px-4 py-2 text-sm text-white bg-orange-500 rounded hover:bg-orange-600 disabled:opacity-50 disabled:cursor-not-allowed"
                                id="submitBtn" {{ $isDisabled ? 'disabled' : '' }}>
                                Submit Approval
                            </button>

                            <a href="{{ url('/supervisor/approve/declineForm/' . $job_draft->id) }}">
                                <button type="button"
                                    class="px-4 py-2 text-sm text-white bg-red-500 rounded hover:bg-red-600 disabled:opacity-50 disabled:cursor-not-allowed"
                                    id="declineBtn" {{ $isDisabled ? 'disabled' : '' }}>
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

    {{-- Include the signature modal (hidden by default) --}}
    <x-signature id="signatureModal" class="hidden" />

{{-- JS for Live Preview, Signature Pad, and Modal Switching --}}
<script>
    // Main Signature Pad
    var canvas = document.getElementById("signature-pad");
    var signaturePad = new SignaturePad(canvas);

    // Resize canvas for better drawing experience
    function resizeCanvas() {
        var ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
        signaturePad.clear(); // Clear canvas after resizing
    }
    window.addEventListener("resize", resizeCanvas);
    resizeCanvas(); // Call on page load

    // Signature Method Buttons
    document.getElementById("useUpload").addEventListener("click", function () {
        toggleSection("upload");
    });
    document.getElementById("usePad").addEventListener("click", function () {
        toggleSection("pad");
    });
    document.getElementById("useSavedSignature").addEventListener("click", function () {
        const userSignature = "{{ Auth::user()->signature }}";
        if (!userSignature) {
            document.getElementById("signatureModal").classList.remove("hidden");
        } else {
            // Use "savedSignature" to match the button id in the toggle logic
            toggleSection("savedSignature");
        }
    });

    function toggleSection(method) {
        const sections = ["uploadSection", "padSection", "savedPadSection"];
        sections.forEach(section => document.getElementById(section).classList.add("hidden"));

        if (method === "upload") {
            document.getElementById("uploadSection").classList.remove("hidden");
        } else if (method === "pad") {
            document.getElementById("padSection").classList.remove("hidden");
            setTimeout(() => resizeCanvas(), 100);
        } else if (method === "savedSignature") {
            document.getElementById("savedPadSection").classList.remove("hidden");
        }

        // Highlight the selected button
        ["useUpload", "usePad", "useSavedSignature"].forEach(btn => {
            document.getElementById(btn).classList.remove("bg-gray-200");
        });
        if (method === "upload") {
            document.getElementById("useUpload").classList.add("bg-gray-200");
        } else if (method === "pad") {
            document.getElementById("usePad").classList.add("bg-gray-200");
        } else if (method === "savedSignature") {
            document.getElementById("useSavedSignature").classList.add("bg-gray-200");
        }

        // Reset hidden inputs
        document.getElementById("signaturePadData").value = "";
        document.getElementById("savedSignatureData").value = method === "savedSignature" ? "{{ asset(Auth::user()->signature) }}" : "";
    }

    // Signature Pad Clear
    document.getElementById("clearPad").addEventListener("click", function () {
        signaturePad.clear();
    });

    // Live Preview for File Upload
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

    // Enable Submit Button on Agreement
    document.getElementById('agree').addEventListener('change', function () {
        document.getElementById('submitBtn').disabled = !this.checked;
    });

    // Form Submission - Correctly capture signaturePad value
    document.getElementById("approvalForm").addEventListener("submit", function (event) {
        // Capture Signature Pad data before submitting
        if (!document.getElementById("uploadSection").classList.contains("hidden")) {
            if (!document.getElementById("signatureInput").value) {
                alert("Please upload an image before submitting.");
                event.preventDefault();
                return;
            }
        } else if (!document.getElementById("padSection").classList.contains("hidden")) {
            if (!signaturePad || signaturePad.isEmpty()) {
                alert("Please sign before submitting.");
                event.preventDefault();
                return;
            } else {
                // Set signaturePad value into hidden input
                const signatureData = signaturePad.toDataURL("image/png");
                document.getElementById("signaturePadData").value = signatureData;
            }
        } else if (!document.getElementById("savedPadSection").classList.contains("hidden")) {
            if (!document.getElementById("savedSignatureData").value) {
                alert("Please select your saved signature before submitting.");
                event.preventDefault();
                return;
            }
        }
    });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const element = document.getElementById('draftContent');
            if (element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth) {
                element.classList.add('border', 'border-gray-200', 'p-4');
            }
        });
    </script>
@endsection
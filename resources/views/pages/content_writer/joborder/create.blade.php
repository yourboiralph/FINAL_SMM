@extends('layouts.application')

@section('title', 'Page Title')
@section('header', "Job Order") 

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
    <div class=" w-full px-6 py-10 mx-auto rounded-lg custom-shadow">
        <div>
            <a href="{{url('/content')}}">
                <div class="w-fit px-4 py-1 bg-[#fa7011] rounded-md text-white custom-shadow custom-hover-shadow">
                    Back
                </div>
            </a>
        </div>
        <form action="{{ url('/content/update/'. $job_draft->id ) }}" method="POST">
            @csrf
            @method('PUT')
            <h1 class="text-xl font-bold mt-4">Create Draft</h1>
            <div class="grid grid-cols-4 space-y-4">
                <div class="col-span-4 grid grid-cols-2 gap-4 mt-4">
                    <div class="col-span-4 grid grid-cols-4">
                        <div class="col-span-1 w-full">
                            <p class="text-sm text-gray-600 border-[#fa7011] border-b-2 w-fit">Title</p>
                            <p class="text-xl font-bold">{{$job_draft->jobOrder->title}}</p>
                        </div>
                        <div class="col-span-1 w-full">
                            <p class="text-sm text-gray-600 border-[#fa7011] border-b-2 w-fit">Client</p>
                            <p class="text-xl font-bold">{{$job_draft->client->name}}</p>
                        </div>
                        <div class="col-span-1 w-full">
                            <p class="text-sm text-gray-600 border-[#fa7011] border-b-2 w-fit">Date Started</p>
                            <p class="text-xl font-bold">{{ \Carbon\Carbon::parse($job_draft->date_started)->format('Y-m-d') }}</p>
                        </div>
                        <div class="col-span-1 w-full">
                            <p class="text-sm text-gray-600 border-[#fa7011] border-b-2 w-fit">Date Target</p>
                            <p class="text-xl font-bold">{{ \Carbon\Carbon::parse($job_draft->date_target)->format('Y-m-d') }}</p>
                        </div>
                    </div>

                    <div class="col-span-2 w-full">
                        <p class="text-sm text-gray-600">Draft</p>
                        <textarea name="draft" class="w-full border-gray-200 rounded-lg custom-shadow custom-focus-ring resize-none min-h-[90px]" oninput="autoResize(this)">{{old('draft', '')}}</textarea>
                    </div>
                </div>

                <button type="submit" class="col-span-1 text-center py-4 w-full bg-[#fa7011] mt-10 rounded-lg custom-shadow custom-hover-shadow text-white font-bold">
                    Submit
                </button>
                
            </div>
        </form>
    </div>


    <!-- Modal -->
<div id="client-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-lg font-semibold mb-4">Select a Client</h2>
        <ul class="max-h-60 overflow-y-auto">

        
        </ul>
        <button onclick="closeModal()" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded">Close</button>
    </div>
</div>
</div>
@endsection

<!-- JavaScript -->
<script>
    function openModal() {
        document.getElementById('client-modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('client-modal').classList.add('hidden');
    }

    function selectClient(clientId, clientName) {
        document.getElementById('selected-client-name').value = clientName; // Show name in the text field
        document.getElementById('selected-client-id').value = clientId; // Store ID in the hidden input
        closeModal();
    }
</script>


<script>
    function autoResize(textarea) {
        textarea.style.height = "90px"; // Reset height to minimum
        textarea.style.height = (textarea.scrollHeight) + "px"; // Adjust height based on content
    }

    // Ensure the textarea resizes on page load (for pre-filled content)
    document.addEventListener("DOMContentLoaded", function() {
        let textarea = document.querySelector('textarea[name="description"]');
        if (textarea) {
            autoResize(textarea);
        }
    });
</script>

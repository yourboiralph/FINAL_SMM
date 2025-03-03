@extends('layouts.application')

@section('title', 'Admin')
@section('header', 'Show Job OrderASD')

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
</style>

<!-- CKEditor 5 Classic -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<div class="container mx-auto p-6">
    <div class="w-full px-6 py-10 mx-auto rounded-lg custom-shadow bg-white">
        <div class="flex items-center justify-between">
            <a href="{{ url('/supervisor/joborder') }}">
                <div class="w-fit px-4 py-1 bg-gray-400 rounded-md text-white custom-shadow custom-hover-shadow">
                    Back
                </div>
            </a>

        </div>
        <h1 class="text-xl font-bold mt-4">Show</h1>
        <div class="mt-4 grid grid-cols-4">
            <div class="col-span-4 flex flex-col space-y-4 mb-10 md:flex-row  md:space-y-0">
                <div class="w-full">
                    <p class="text-sm font-bold text-gray-600">Title</p>
                    <p class="border-b-2 border-[#fa7011] w-fit">{{ $supervisor_request->title }}</p>
                </div>
                <div class="w-full">
                    <p class="text-sm font-bold text-gray-600">Issued By</p>
                    <p class="border-b-2 border-[#fa7011] w-fit">{{ $supervisor_request->issuer->name }}</p>
                </div>
            </div>
            <div class="col-span-4 h-fit">
                <p class="text-sm font-bold text-gray-600">Instructions</p>

                <!-- CKEditor Read-Only -->
                <div class="border border-gray-400 rounded-lg break-words max-h-[500px] p-2 overflow-y-auto">
                    {!! $supervisor_request->description !!}
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    // Initialize CKEditor in Read-Only mode
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: false, // Hide toolbar since it's read-only
            readOnly: true // Disable editing
        })
        .then(editor => {
            console.log('CKEditor (Read-Only) initialized');
        })
        .catch(error => {
            console.error(error);
        });
</script>

@endsection


@extends('layouts.application')

@section('title', 'Supervisor')
@section('header', 'Supervisor Job Order')

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
</style>

<!-- CKEditor 5 Classic -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<style>

    .header, .footer {
        text-align: center;
    }
    .header img, .footer img {
        width: 100%;
        max-height: 150px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }
    td, th {
        border: 1px solid black;
        padding: 10px;
        text-align: left;
        vertical-align: top;
    }
    .highlight {
        background-color: #fa7011;
        height: 40px;
        text-align: center;
    }
    .gray-bar {
        background-color: #6b7280;
        height: 40px;
        text-align: center;
    }
    .section{
        border: 1px solid black;
    }
    .section-title {
        font-weight: bold;
        background-color: #6b7280;
        color: white;
        text-align: center;
    }
    .signature img {
        width: 100px;
        height: auto;
    }
    .section-remarks {
        padding: 10px;
    }
    #container-pdf{
        padding: 20px
    }
</style>
<div id="container-pdf">
    <div class="bg-[#fa7011] text-white rounded-md px-3 py-1 w-fit mb-4">
        <a href="{{url('/content')}}">Back</a>
    </div>
    <div class="header">
        <img src="{{ asset('/Assets/doc_header.png') }}" alt="Header">
        <h2>Operation Job Order Form</h2>
    </div>

    <div class="section">
        <div class="highlight"></div>
        <table>
            <tr>
                <td><strong>Client Name:</strong><br>N/A</td>
                <td><strong>Client Address:</strong><br>N/A</td>
            </tr>
        </table>
        <div class="gray-bar"></div>
        <table>
            <tr>
                <td><strong>Date Issued:</strong><br>
                    {{ $supervisor_request->date_started ? \Carbon\Carbon::parse($supervisor_request->date_started)->format('Y-m-d') : 'N/A' }}
                </td>
                
                <td><strong>Target Finished Date:</strong><br>
                    {{ $supervisor_request->date_started ? \Carbon\Carbon::parse($supervisor_request->date_started)->addDays($job_draft->days_to_add)->format('Y-m-d') : 'N/A' }}
                </td>
                          
            </tr>
        </table>
        <table>
            <tr>
                <td><strong>Issued by:</strong><br>{{ $job_draft->jobOrder->issuer->name }}</td>
                <td>
                    <strong>Work Performed by:</strong><br>
                    @if ($job_draft->type == "content_writer")
                        {{ $job_draft->contentWriter->name }}
                    @else
                        {{ $job_draft->graphicDesigner->name }}
                    @endif
                </td>
            </tr>
        </table>
        <div class="section-remarks">
            <strong>Description:</strong>
            <div class="text-sm text-gray-600 w-full max-h-[500px] overflow-y-auto bg-white border border-gray-300 p-2 rounded">
                {!! $job_draft->jobOrder->description !!}
            </div>
        </div>
        <div class="gray-bar"></div>
        <div class=""><strong> Complete Information </strong></div>
        <table>
            <tr>
                <td><strong>Date Completed:</strong><br>
                    {{ $job_draft->date_completed ? \Carbon\Carbon::parse($job_draft->date_completed)->format('Y-m-d') : 'N/A' }}
                </td>
                
                <td><strong>Time Required:</strong><br>
                    @if($job_draft->date_started && $job_draft->date_completed)
                        {{ \Carbon\Carbon::parse($job_draft->date_started)->diffInDays(\Carbon\Carbon::parse($job_draft->date_completed)) }} days
                    @else
                        N/A
                    @endif
                </td>                             
            </tr>
        </table>
        <div class="section-remarks">
            <strong>Remarks:</strong>
            <div class="text-sm text-gray-600 w-full max-h-[500px] overflow-y-auto bg-white border border-gray-300 p-2 rounded">
                {!! $job_draft->feedback !!}
            </div>
        </div>
        <table>
            <tr>
                <td class="signature">
                    <strong>Assigned Personnel Signature:                     @if ($job_draft->type == "content_writer")
                        {{ $job_draft->contentWriter->name }}
                    @else
                        {{ $job_draft->graphicDesigner->name }}
                    @endif</strong><br>
                    <img src="{{ asset($job_draft->signature_worker) }}" alt="Admin Signature">
                </td>
                <td class="signature">
                    <strong>Supervisor Signature: {{$job_draft->jobOrder->issuer->name}}</strong><br>
                    <img src="{{ asset($job_draft->signature_supervisor) }}" alt="Supervisor Signature">
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <img src="{{ asset('/Assets/doc_footer.png') }}" alt="Footer">
    </div>
</div>

@endsection



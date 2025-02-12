<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>FINAL SMM</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            margin: 0;
        }
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
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('/Assets/doc_header.png') }}" alt="Header">
        <h2>Operation Job Order Form</h2>
    </div>

    <div class="section">
        <div class="highlight"></div>
        <table>
            <tr>
                <td><strong>Client Name:</strong><br>{{ $job_draft->client->name }}</td>
                <td><strong>Client Address:</strong><br>{{ $job_draft->client->address }}</td>
            </tr>
        </table>
        <div class="gray-bar"></div>
        <table>
            <tr>
                <td><strong>Date Issued:</strong><br>{{ $job_draft->date_started }}</td>
                <td><strong>Target Finished Date:</strong><br>{{ $job_draft->date_target }}</td>
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
            <p>{!! $job_draft->jobOrder->description !!}</p>
        </div>
        <div class="gray-bar"></div>
        <div class=""><strong> Complete Information </strong></div>
        <table>
            <tr>
                <td><strong>Date Completed:</strong><br>{{ $job_draft->date_completed }}</td>
                <td><strong>Time Required:</strong><br>{{ $job_draft->date_target }}</td>
            </tr>
        </table>
        <div class="section-remarks">
            <strong>Remarks:</strong>
            <p>{!! $job_draft->feedback !!}</p>
        </div>
        <table>
            <tr>
                <td class="signature">
                    <strong>Assigned Personnel Signature:</strong><br>
                    <img src="{{ public_path($job_draft->signature_admin) }}" alt="Admin Signature">
                </td>
                <td class="signature">
                    <strong>Supervisor Signature:</strong><br>
                    <img src="{{ public_path($job_draft->signature_top_manager) }}" alt="Supervisor Signature">
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <img src="{{ public_path('/Assets/doc_footer.png') }}" alt="Footer">
    </div>
</body>
</html>

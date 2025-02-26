@extends('layouts.application')

@section('title', 'Job Order')
@section('header', 'Request Form')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>


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
    .active-tab {
        border-bottom: 2px solid #fa7011;
    }
    body {
            font-family: Arial, sans-serif;

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
        .long-bar{
            border: 1px solid black;
            padding: 10px;
            text-align: left;
            vertical-align: top;
            font-weight: bold;
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

        #signature-2 {
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
</style>

<div class="container mx-auto p-4 sm:p-6">
    <body>
        <div class="header">
            <img src="{{ asset('/Assets/doc_header.png') }}" alt="Header">
            <h2>Request Form</h2>
        </div>
    
        <div class="section">
            <div class="highlight"></div>
            <table>
                <tr>
                    <td><strong>Department:</strong><br>
                    </td>
                    <td><strong>Date:</strong><br></td>
                </tr>
            </table>
            <div class="long-bar">
                <p>Requested By: </p>
            </div>
            <div class="gray-bar"></div>
            <table>
                <tr>
                    <td><strong>Particulars:</strong><br>

                            <label><input type="checkbox" name="particulars[]" value="Domain"> Domain</label><br>
                            <label><input type="checkbox" name="particulars[]" value="Hosting and Servers"> Hosting and Servers</label><br>
                            <label><input type="checkbox" name="particulars[]" value="Office Supplies"> Office Supplies</label><br>
                            <label><input type="checkbox" name="particulars[]" value="Fare"> Fare</label><br>
                            <label><input type="checkbox" name="particulars[]" value="Petty Cash"> Petty Cash</label><br>
                            <label><input type="checkbox" name="particulars[]" value="Credit Card"> Credit Card</label><br>
                            <label><input type="checkbox" name="particulars[]" value="Office Asset / Cash Advance"> Office Asset / Cash Advance</label><br>
                            <label><input type="checkbox" name="particulars[]" value="Car"> Car</label><br>
                            <label><input type="checkbox" name="particulars[]" value="Flyers"> Flyers</label><br>
                        
                    </td>
                        <td>
                            <label><input type="checkbox" name="particulars[]" value="for Multimedia Use"> for Multimedia Use</label><br>
                            <label><input type="checkbox" name="particulars[]" value="Cash Advance"> Cash Advance</label><br>
                            <label><input type="checkbox" name="particulars[]" value="Signage"> Signage</label><br>
                            <label><input type="checkbox" name="particulars[]" value="Reimbursement"> Reimbursement</label><br>
                            <label><input type="checkbox" name="particulars[]" value="For Marketing Use"> For Marketing Use</label><br>
                            <label><input type="checkbox" name="particulars[]" value="Ads - AUB"> Ads - AUB</label><br>
                            <label><input type="checkbox" name="particulars[]" value="Repair and Maintenance"> Repair and Maintenance</label><br>
                            <label><input type="checkbox" name="particulars[]" value="Refund"> Refund</label><br>
                            <label>
                                <input type="checkbox" name="particulars[]" value="Others">
                                Others: <input type="text" name="other_particulars" class="border p-1">
                            </label>
                        </td>
                </tr>
            </table>
            
            <div class="long-bar" id="open-modal">
                <strong>Description:</strong>
                <div class="text-sm text-gray-600 w-full max-h-[500px] overflow-y-auto bg-white border border-gray-300 p-2 rounded">
                    
                    
                </div>
            </div>

            <div>
                <div id="signature-2">
                    <div>
                        <strong>Requested By:</strong><br>
                        <img src="{{ asset($users) }}" alt="Supervisor Signature">
                    </div>
                    <div>
                        <strong>Received By:</strong><br>
                        <img src="{{ asset($users) }}" alt="Supervisor Signature">
                    </div>
                </div>

                <div id="signature-2">

                    <div>
                        <strong>Manager:</strong><br>
                        <img src="{{ asset($users) }}" alt="Supervisor Signature">

                    </div>
                </div>
            </div>
            
        </div>
    
        <div class="footer">
            <img src="{{ asset('/Assets/doc_footer.png') }}" alt="Footer">
        </div>
    </body>
</div>


<!-- Modal -->
<div id="description-modal" class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
        <div class="h-40 overflow-y-auto">
            <label><input type="checkbox" name="particulars[]" value="Domain"> Domain</label><br>
            <label><input type="checkbox" name="particulars[]" value="Hosting and Servers"> Hosting and Servers</label><br>
            <label><input type="checkbox" name="particulars[]" value="Office Supplies"> Office Supplies</label><br>
            <label><input type="checkbox" name="particulars[]" value="Fare"> Fare</label><br>
            <label><input type="checkbox" name="particulars[]" value="Petty Cash"> Petty Cash</label><br>
            <label><input type="checkbox" name="particulars[]" value="Credit Card"> Credit Card</label><br>
            <label><input type="checkbox" name="particulars[]" value="Office Asset / Cash Advance"> Office Asset / Cash Advance</label><br>
            <label><input type="checkbox" name="particulars[]" value="Car"> Car</label><br>
            <label><input type="checkbox" name="particulars[]" value="Flyers"> Flyers</label><br>
            <label><input type="checkbox" name="particulars[]" value="for Multimedia Use"> for Multimedia Use</label><br>
            <label><input type="checkbox" name="particulars[]" value="Cash Advance"> Cash Advance</label><br>
            <label><input type="checkbox" name="particulars[]" value="Signage"> Signage</label><br>
            <label><input type="checkbox" name="particulars[]" value="Reimbursement"> Reimbursement</label><br>
            <label><input type="checkbox" name="particulars[]" value="For Marketing Use"> For Marketing Use</label><br>
            <label><input type="checkbox" name="particulars[]" value="Ads - AUB"> Ads - AUB</label><br>
            <label><input type="checkbox" name="particulars[]" value="Repair and Maintenance"> Repair and Maintenance</label><br>
            <label><input type="checkbox" name="particulars[]" value="Refund"> Refund</label><br>
            <label>
                <input type="checkbox" name="particulars[]" value="Others">
                Others: <input type="text" name="other_particulars" class="border p-1">
            </label>
        </div>
        <div class="mt-4">
            <h1 class="font-bold">Date:</h1>
            <input type="date" name="date" class="border p-2 w-full rounded">
        </div>
        <div class="mt-4">
            <h1 class="font-bold">Description:</h1>
            <textarea id="description-editor" name="description"></textarea>
        </div>
        <div class="mt-4 flex justify-end">
            <button id="close-modal" class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
            <button id="save-description" class="ml-2 px-4 py-2 bg-orange-500 text-white rounded">Save</button>
        </div>
    </div>
</div>


<!-- CKEditor Script -->
<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const openModal = document.getElementById("open-modal");
        const modal = document.getElementById("description-modal");
        const closeModal = document.getElementById("close-modal");
        const saveButton = document.getElementById("save-description");
        const descriptionInput = document.getElementById("description-input");

        openModal.addEventListener("click", function () {
            modal.classList.remove("hidden");
        });

        closeModal.addEventListener("click", function () {
            modal.classList.add("hidden");
        });

        saveButton.addEventListener("click", function () {
            openModal.querySelector("div").textContent = descriptionInput.value || "Click to add description...";
            modal.classList.add("hidden");
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Initialize CKEditor
        CKEDITOR.replace('description-editor');

        const openModal = document.getElementById("open-modal");
        const modal = document.getElementById("description-modal");
        const closeModal = document.getElementById("close-modal");
        const saveButton = document.getElementById("save-description");

        openModal.addEventListener("click", function () {
            modal.classList.remove("hidden");
        });

        closeModal.addEventListener("click", function () {
            modal.classList.add("hidden");
        });

        saveButton.addEventListener("click", function () {
            let description = CKEDITOR.instances['description-editor'].getData();
            console.log("Saved Description:", description);
            modal.classList.add("hidden");
        });
    });
</script>
@endsection

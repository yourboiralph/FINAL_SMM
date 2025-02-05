<?php

namespace App\Http\Controllers;

use App\Models\JobDraft;
use App\Models\JobOrder;
use App\Models\User;
use Illuminate\Http\Request;

class JobOrderController extends Controller
{
    public function index()
    {
        $job_drafts = JobDraft::with('jobOrder')->where('status', 'pending')->get();
        return view('pages/admin/joborder/joborder', compact('job_drafts'));
    }
    public function create()
    {
        $content_writers = User::where('role_id', 3)->get();
        $graphic_designers = User::where('role_id', 4)->get();
        $clients = User::where('role_id', 1)->get();

        return view('pages.admin.joborder.create', compact('content_writers', 'graphic_designers', 'clients'));
    }
    public function store(Request $request)
    {
        // Validate request before proceeding
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'content_writer_id' => 'required|integer',
            'graphic_designer_id' => 'required|integer',
            'client_id' => 'required|integer',
            'date_target' => 'required|date',
            'date_started' => 'required|date'
        ]);

        $job_order = JobOrder::create([
            'title' => $request->title,
            'description' => $request->description,
            'content_writer_id' => $request->content_writer_id,
            'graphic_designer_id' => $request->graphic_designer_id,
            'client_id' => $request->client_id,
            'issued_by' => auth()->user()->id,
        ]);

        $job_draft = JobDraft::create([
            'job_order_id' => $job_order->id,
            'type' => 'content_writer',
            'date_started' => $request->date_started,
            'date_target' => $request->date_target,
            'status' => 'new'
        ]);

        return redirect()->route('joborder.create')->with('status', 'Job Order Create Successfully');
    }

    public function show($id)
    {
        $job_order = JobOrder::findOrFail($id);
        return view('pages.admin.joborder.show', compact('job_order'));
    }

    public function edit($id)
    {
        $content_writers = User::where('role_id', 3)->get();
        $graphic_designers = User::where('role_id', 4)->get();
        $clients = User::where('role_id', 1)->get();
        $job_order = JobOrder::with('latest_job_draft', 'client', 'contentWriter', 'graphicDesigner')->find($id);

        return view('pages.admin.joborder.edit', compact('job_order', 'content_writers', 'graphic_designers', 'clients'));
    }
    public function update(Request $request, $id)
    {
        // Validate request before proceeding
        $request->validate([
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
            'content_writer_id' => 'sometimes|integer',
            'graphic_designer_id' => 'sometimes|integer',
            'client_id' => 'sometimes|integer',
            'date_target' => 'sometimes|date',
            'date_started' => 'sometimes|date'
        ]);

        // Find the job order by ID
        $job_order = JobOrder::findOrFail($id);

        // Update job order details
        $job_order->update([
            'title' => $request->title,
            'description' => $request->description,
            'content_writer_id' => $request->content_writer_id,
            'graphic_designer_id' => $request->graphic_designer_id,
            'client_id' => $request->client_id,
        ]);

        // Find the related job draft
        $job_draft = JobDraft::where('job_order_id', $job_order->id)->first();

        $job_draft->update([
            'date_started' => $request->date_started,
            'date_target' => $request->date_target,
        ]);


        return redirect()->route('joborder.edit', $id)->with('status', 'Job Order Updated Successfully');
    }
}










// @foreach ($job_drafts as $job_draft)
//     <div>
//         <h3>Job Draft ID: {{ $job_draft->id }}</h3>
//         <p>Type: {{ $job_draft->type }}</p>
//         <p>Date Started: {{ $job_draft->date_started }}</p>
//         <p>Date Target: {{ $job_draft->date_target }}</p>
//         <p>Signature Admin: {{ $job_draft->signature_admin ?? 'Not signed' }}</p>
//         <p>Signature Top Manager: {{ $job_draft->signature_top_manager ?? 'Not signed' }}</p>
//         <p>Status: {{ $job_draft->status }}</p>

//         <!-- Access job_order relationship -->
//         <h4>Job Order:</h4>
//         <p>Title: {{ $job_draft->jobOrder->title ?? 'No job order available' }}</p>
//         <p>Description: {{ $job_draft->jobOrder->description ?? 'No description available' }}</p>
//         <p>Client ID: {{ $job_draft->jobOrder->client_id ?? 'N/A' }}</p>
//     </div>
// @endforeach

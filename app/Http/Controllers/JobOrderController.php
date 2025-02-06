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
        $job_drafts = JobDraft::with('jobOrder', 'contentWriter', 'graphicDesigner')->where('status', 'pending')->get();
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
            'status' => 'pending'
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
        $job_draft = JobDraft::with('jobOrder', 'contentWriter', 'graphicDesigner', 'client')->find($id);

        return view('pages.admin.joborder.edit', compact('job_draft', 'content_writers', 'graphic_designers', 'clients'));
    }

    public function update(Request $request, $id, $jdID)
    {
        // Validate request before proceeding
        $request->validate([
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
            'content_writer_id' => 'sometimes|integer',
            'graphic_designer_id' => 'sometimes|integer|nullable',
            'client_id' => 'sometimes|integer|nullable',
            'date_target' => 'sometimes|date',
            'date_started' => 'sometimes|date'
        ]);

        // Find the job order by ID
        $job_order = JobOrder::findOrFail($id);

        // Create an array for updating fields
        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        // Conditionally update graphic_designer_id and client_id if provided
        if ($request->has('graphic_designer_id') && $request->graphic_designer_id !== null) {
            $updateData['graphic_designer_id'] = $request->graphic_designer_id;
        }

        if ($request->has('client_id') && $request->client_id !== null) {
            $updateData['client_id'] = $request->client_id;
        }

        if ($request->has('content_writer_id') && $request->content_writer_id !== null) {
            $updateData['content_writer_id'] = $request->content_writer_id;
        }

        // Update the job order
        $job_order->update($updateData);

        // Find the related job draft
        $job_draft = JobDraft::where('job_order_id', $job_order->id)->where('id', $jdID)->first();

        if ($job_draft) {
            $job_draft->update([
                'date_started' => $request->date_started,
                'date_target' => $request->date_target,
            ]);
        }

        return redirect()->route('joborder.edit', $id)->with('Status', 'Job Order Updated Successfully');
    }
}

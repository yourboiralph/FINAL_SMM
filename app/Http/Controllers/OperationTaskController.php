<?php

namespace App\Http\Controllers;

use App\Models\JobDraft;
use Illuminate\Http\Request;

class OperationTaskController extends Controller
{
    public function index()
    {
        $authuser = auth()->user();

        // Fetch all job drafts for the authenticated user
        $job_drafts = JobDraft::where(function ($query) use ($authuser) {
            $query->where('content_writer_id', $authuser->id)
                ->orWhere('graphic_designer_id', $authuser->id);
        })
            ->where('status', 'pending')
            ->with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client']) // Ensures relations are loaded
            ->get();

        return view('pages.admin.task.list', compact('job_drafts'));
    }

    public function show($id)
    {
        // Fetch the job draft with related models
        $job_draft = JobDraft::with('jobOrder', 'contentWriter', 'graphicDesigner', 'client', 'parentDraft')->find($id);

        // Pass both the job draft and the latest job draft to the view
        return view('pages.admin.task.show', compact('job_draft'));
    }

    public function edit($id)
    {
        // Fetch the job draft with related models
        $job_draft = JobDraft::with('jobOrder', 'contentWriter', 'graphicDesigner', 'client', 'parentDraft')->find($id);

        // Pass both the job draft and the latest job draft to the view
        return view('pages.admin.task.edit', compact('job_draft'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'draft' => 'required'
        ]);

        $job_draft = JobDraft::findOrFail($id);

        $job_draft->update([
            'draft' => $request->draft,
            'status' => 'Submitted to Operations',
        ]);

        return redirect()->route('operation.task')->with('Status', 'Job Order Updated Successfully');
    }
}

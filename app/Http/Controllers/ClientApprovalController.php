<?php

namespace App\Http\Controllers;

use App\Models\JobDraft;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientApprovalController extends Controller
{
    public function index()
    {
        $authuser = auth()->user();

        // Fetch all job drafts for the authenticated user
        $job_drafts = JobDraft::where('client_id', $authuser->id)
            ->where('status', 'Approved by Top Manager')
            ->with('jobOrder', 'contentWriter', 'graphicDesigner', 'client') // Corrected ->with() usage
            ->get();

        return view('pages.client.joborder.list', compact('job_drafts'));
    }

    public function show($id)
    {
        $job_draft = JobDraft::with('jobOrder', 'contentWriter', 'graphicDesigner', 'client')->find($id);
        return view('pages.client.joborder.show', compact('job_draft'));
    }

    public function edit($id)
    {
        $job_draft = JobDraft::with('jobOrder', 'contentWriter', 'graphicDesigner', 'client')->find($id);
        return view('pages.client.joborder.edit', compact('job_draft'));
    }

    public function update(Request $request, $id)
    {
        $job_draft_id = JobDraft::with('jobOrder', 'contentWriter', 'graphicDesigner', 'client')->find($id);

        $job_draft_id->update([
            'status' => 'complete'
        ]);

        if ($job_draft_id->type == 'content_writer') {
            JobDraft::create([
                'job_order_id' => $job_draft_id->job_order_id,
                'type' => 'graphic_designer',
                'date_target' => Carbon::now()->addDays(3),
                'status' => 'pending',
                'content_writer_id' => $job_draft_id->content_writer_id,
                'graphic_designer_id' => $job_draft_id->graphic_designer_id,
                'client_id' => $job_draft_id->client_id,
            ]);
        }
    }
}

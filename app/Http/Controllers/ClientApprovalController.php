<?php

namespace App\Http\Controllers;

use App\Models\JobDraft;
use App\Models\Revision;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientApprovalController extends Controller
{
    public function index()
    {
        $authuser = auth()->user();

        // Fetch all job drafts for the authenticated user
        $job_drafts = JobDraft::where('client_id', $authuser->id)
            ->where('status', 'Submitted to Client')
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
            'feedback' => $request->feedback,
            'status' => 'completed',
            'date_completed' => now(),
        ]);

        if ($job_draft_id->type == 'content_writer') {
            JobDraft::create([
                'job_order_id' => $job_draft_id->job_order_id,
                'type' => 'graphic_designer',
                'date_target' => Carbon::now()->addDays(3)->toDateString(),
                'status' => 'pending',
                'content_writer_id' => $job_draft_id->content_writer_id,
                'graphic_designer_id' => $job_draft_id->graphic_designer_id,
                'client_id' => $job_draft_id->client_id,
                'reference_draft_id' => $id
            ]);
        }
        return redirect()->route('client.approve')->with('Status', 'Job Order Approved Successfully');
    }
    public function declineForm($id)
    {
        $job_draft = JobDraft::with('jobOrder', 'contentWriter', 'graphicDesigner', 'client')->find($id);
        return view('pages.client.joborderapproval.declineform', compact('job_draft'));
    }

    public function decline(Request $request, $id)
    {
        $request->validate([
            'summary' => 'required',
        ]);

        // Update Database with Signature Path
        Revision::create([
            'job_draft_id' => $id,
            'declined_by' => auth()->user()->id,
            'summary' => $request->summary,
        ]);

        $job_draft = JobDraft::find($id);

        $job_draft->update([
            'status' => 'Revision',
            'signature_admin' => null,
            'admin_signed' => null,
            'signature_top_manager' => null,
            'top_manager_signed' => null
        ]);
        return redirect()->route('client.approve')->with('Status', 'Job Order Declined Successfully');
    }
}

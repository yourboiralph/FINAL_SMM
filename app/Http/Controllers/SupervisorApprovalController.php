<?php

namespace App\Http\Controllers;

use App\Models\JobDraft;
use App\Models\Revision;
use Illuminate\Http\Request;

class SupervisorApprovalController extends Controller
{
    public function index()
    {
        $job_drafts = JobDraft::where('status', 'Submitted to Supervisor')
            ->with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client'])
            ->get();

        return view('pages.supervisor.joborderapproval.list', compact('job_drafts'));
    }

    public function show($id)
    {
        $job_draft = JobDraft::with('jobOrder', 'contentWriter', 'graphicDesigner', 'client')->find($id);
        return view('pages.supervisor.joborderapproval.show', compact('job_draft'));
    }

    public function edit($id)
    {
        $job_draft = JobDraft::with('jobOrder', 'contentWriter', 'graphicDesigner', 'client')->find($id);
        return view('pages.supervisor.joborderapproval.edit', compact('job_draft'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'signature_admin' => 'required_without:signature_pad|image|mimes:jpeg,png,jpg,gif|max:2048',
            'signature_pad'   => 'required_without:signature_admin|string',
        ]);

        $job_draft = JobDraft::findOrFail($id);
        $imagePath = $job_draft->signature_supervisor; // Keep existing signature if no new one is uploaded

        // Handle File Upload
        if ($request->hasFile('signature_supervisor')) {
            $file = $request->file('signature_supervisor');
            $imagePath = 'signatures/' . time() . '.' . $file->extension();
            $file->move(public_path('signatures'), $imagePath);
        }

        // Handle Signature Pad Input
        elseif ($request->signature_pad) {
            $image = str_replace('data:image/png;base64,', '', $request->signature_pad);
            $imagePath = 'signatures/signature_' . time() . '.png';
            file_put_contents(public_path($imagePath), base64_decode($image));
        } elseif ($request->new_signature_pad) {
            $image = str_replace('data:image/png;base64,', '', $request->new_signature_pad);
            $imagePath = 'signatures/signature_' . time() . '.png';
            file_put_contents(public_path($imagePath), base64_decode($image));
        }

        // Update Database with Signature Path
        $job_draft->update([
            'signature_supervisor' => $imagePath,
            'supervisor_signed' => auth()->user()->id,
            'status' => 'Submitted to Top Manager',
        ]);

        return redirect()->route('supervisor.approve')->with('Status', 'Job Order Approved Successfully');
    }
    public function declineForm($id)
    {
        $job_draft = JobDraft::with('jobOrder', 'contentWriter', 'graphicDesigner', 'client')->find($id);
        return view('pages.supervisor.joborderapproval.declineform', compact('job_draft'));
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
        ]);
        return redirect()->route('supervisor.approve')->with('Status', 'Job Order Declined Successfully');
    }
}

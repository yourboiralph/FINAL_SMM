<?php

namespace App\Http\Controllers;

use App\Models\JobDraft;
use App\Models\Revision;
use Illuminate\Http\Request;

class TopApprovalController extends Controller
{
    public function index()
    {
        $job_drafts = JobDraft::where('status', 'Submitted to Top Manager')
            ->with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client'])
            ->get();

        return view('pages.topmanager.joborderapproval.list', compact('job_drafts'));
    }

    public function show($id)
    {
        $job_draft = JobDraft::with('jobOrder', 'contentWriter', 'graphicDesigner', 'client')->find($id);
        return view('pages.topmanager.joborderapproval.show', compact('job_draft'));
    }

    public function edit($id)
    {
        $job_draft = JobDraft::with('jobOrder', 'contentWriter', 'graphicDesigner', 'client')->find($id);
        return view('pages.topmanager.joborderapproval.edit', compact('job_draft'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'signature_top_manager' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'signature_pad' => 'nullable|string',
        ]);

        $job_draft = JobDraft::findOrFail($id);
        $imagePath = $job_draft->signature_top_manager; // Keep existing signature if no new one is uploaded

        // Handle File Upload
        if ($request->hasFile('signature_top_manager')) {
            $file = $request->file('signature_top_manager');
            $imagePath = 'signatures/' . time() . '.' . $file->extension();
            $file->move(public_path('signatures'), $imagePath);
        }

        // Handle Signature Pad Input
        elseif ($request->signature_pad) {
            $image = str_replace('data:image/png;base64,', '', $request->signature_pad);
            $imagePath = 'signatures/signature_' . time() . '.png';
            file_put_contents(public_path($imagePath), base64_decode($image));
        }

        // Update Database with Signature Path
        $job_draft->update([
            'signature_top_manager' => $imagePath,
            'top_manager_signed' => auth()->user()->id,
            'status' => 'Submitted to Client',
        ]);

        return redirect()->route('topmanager.approve')->with('Status', 'Job Order Approved Successfully');
    }

    public function declineForm($id)
    {
        $job_draft = JobDraft::with('jobOrder', 'contentWriter', 'graphicDesigner', 'client')->find($id);
        return view('pages.topmanager.joborderapproval.declineform', compact('job_draft'));
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
        return redirect()->route('topmanager.approve')->with('Status', 'Job Order Declined Successfully');
    }
}

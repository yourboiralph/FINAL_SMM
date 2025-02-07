<?php

namespace App\Http\Controllers;

use App\Models\JobDraft;
use Illuminate\Http\Request;

class OperationApprovalController extends Controller
{
    public function index()
    {
        $job_drafts = JobDraft::whereNot('status', 'completed')
            ->with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client'])
            ->get();

        return view('pages.admin.joborderapproval.list', compact('job_drafts'));
    }

    public function show($id)
    {
        $job_draft = JobDraft::with('jobOrder', 'contentWriter', 'graphicDesigner', 'client')->find($id);
        return view('pages.admin.joborderapproval.show', compact('job_draft'));
    }

    public function edit($id)
    {
        $job_draft = JobDraft::with('jobOrder', 'contentWriter', 'graphicDesigner', 'client')->find($id);
        return view('pages.admin.joborderapproval.show', compact('job_draft'));
    }

    public function update(Request $request, $id)
    {
        dd($request->all(), $id);

        $request->validate([
            'signature_admin' => 'required',
        ]);

        $job_draft = JobDraft::findOrFail($id);

        $job_draft->update([
            'signature_admin' => $request->signature_admin,
            'admin_signed' => auth()->user()->id,
            'status' => 'Approved by Operations',
        ]);

        return redirect()->route('content')->with('Status', 'Job Order Updated Successfully');
    }
}

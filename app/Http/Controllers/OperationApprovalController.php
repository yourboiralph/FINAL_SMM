<?php

namespace App\Http\Controllers;

use App\Models\JobDraft;
use Illuminate\Http\Request;

class OperationApprovalController extends Controller
{
    public function index()
    {
        $job_drafts = JobDraft::where('status', 'Submitted to Operations')
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
        return view('pages.admin.joborderapproval.edit', compact('job_draft'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'signature_admin' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'signature_pad' => 'nullable|string',
        ]);

        $job_draft = JobDraft::findOrFail($id);
        $imagePath = $job_draft->signature_admin; // Keep existing signature if no new one is uploaded

        // Handle File Upload
        if ($request->hasFile('signature_admin')) {
            $file = $request->file('signature_admin');
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
            'signature_admin' => $imagePath,
            'admin_signed' => auth()->user()->id,
            'status' => 'Submitted to Top Manager',
        ]);

        return redirect()->route('operation.approve')->with('Status', 'Job Order Approved Successfully');
    }

    public function decline() {}
}

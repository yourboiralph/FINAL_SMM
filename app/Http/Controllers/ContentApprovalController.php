<?php

namespace App\Http\Controllers;

use App\Models\JobDraft;
use Illuminate\Http\Request;

class ContentApprovalController extends Controller
{
    public function index()
    {
        $authuser = auth()->user();

        // Fetch all job drafts for the authenticated user
        $job_drafts = JobDraft::where('content_writer_id', $authuser->id)
            ->where('status', 'pending')
            ->with('jobOrder', 'contentWriter', 'graphicDesigner', 'client') // Corrected ->with() usage
            ->get();

        return view('pages.content_writer.joborder.list', compact('job_drafts'));
    }

    public function edit($id)
    {
        $job_draft = JobDraft::with('jobOrder', 'contentWriter', 'graphicDesigner', 'client')->find($id);
        return view('pages.content_writer.joborder.create', compact('job_draft'));
    }
}

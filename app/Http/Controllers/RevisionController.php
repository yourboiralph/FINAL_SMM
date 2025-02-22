<?php

namespace App\Http\Controllers;

use App\Models\JobDraft;
use App\Models\JobOrder;
use Illuminate\Http\Request;

class RevisionController extends Controller
{
    public function index()
    {
        // Fetch job orders that have at least one revision in their drafts
        $job_drafts = JobDraft::with('jobOrder', 'contentWriter', 'graphicDesigner', 'client')
            ->whereHas('revisions')
            ->get();

        return view('pages.revision.index', compact('job_drafts'));
    }
}

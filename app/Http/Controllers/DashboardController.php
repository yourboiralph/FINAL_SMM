<?php

namespace App\Http\Controllers;

use App\Models\JobDraft;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        $user_role = $user->role->id;

        if ($user_role == 1) {
            $job_drafts = JobDraft::with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client'])
                ->where('client_id', $user->id)
                ->whereIn('status', ['Submitted to Client', 'completed'])
                ->orderBy('id', 'desc') // Sort by id descending
                ->take(5) // Get the latest 5 data
                ->get();

            return view('dashboard', compact('job_drafts'));
        } elseif ($user_role == 2) {
            $job_drafts = JobDraft::with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client'])
                ->whereNot('status', "pending")
                ->orderBy('id', 'desc') // Sort by id descending
                ->limit(5) // Ensure a maximum of 5 records
                ->get();

            return view('dashboard', compact('job_drafts'));
        } elseif ($user_role == 3) {
            $job_drafts = JobDraft::with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client'])
                ->where('content_writer_id', $user->id)
                ->where('type', 'content_writer')
                ->orderBy('id', 'desc') // Sort by id descending
                ->take(5) // Get the latest 5 data
                ->get();

            $job_drafts_revisions = JobDraft::with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client'])
                ->where('content_writer_id', $user->id)
                ->where('type', 'content_writer')
                ->where('status', 'Revision')
                ->orderBy('id', 'desc') // Sort by id descending
                ->take(5) // Get the latest 5 data
                ->get();
            return view('dashboard', compact('job_drafts', 'job_drafts_revisions'));
        } elseif ($user_role == 4) {
            $job_drafts = JobDraft::with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client'])
                ->where('graphic_designer_id', $user->id)
                ->where('type', 'graphic_designer')
                ->orderBy('id', 'desc') // Sort by id descending
                ->take(5) // Get the latest 5 data
                ->get();

            $job_drafts_revisions = JobDraft::with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client'])
                ->where('graphic_designer_id', $user->id)
                ->where('type', 'graphic_designer')
                ->where('status', 'Revision')
                ->orderBy('id', 'desc') // Sort by id descending
                ->take(5) // Get the latest 5 data
                ->get();

            return view('dashboard', compact('job_drafts', 'job_drafts_revisions'));
        } elseif ($user_role == 5) {
            $job_drafts = JobDraft::with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client'])
                ->whereIn('status', ['Submitted to Client', 'completed', 'Submitted to Top Manager'])
                ->orderBy('id', 'desc') // Sort by id descending
                ->take(5) // Get the latest 5 data
                ->get();

            return view('dashboard', compact('job_drafts'));
        } elseif ($user_role == 6) {
            $job_drafts = JobDraft::with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client'])
                ->orderBy('id', 'desc') // Sort by id descending
                ->take(5) // Get the latest 5 data
                ->get();
            return view('dashboard', compact('job_drafts'));
        }
    }
}

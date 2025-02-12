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
                ->orderBy('id', 'desc') // Sort by id descending
                ->take(5) // Get the latest 5 data
                ->get();

            return view('dashboard', compact('job_drafts'));
        } elseif ($user_role == 2) {
            $job_drafts = JobDraft::with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client'])
                ->orderBy('id', 'desc') // Sort by id descending
                ->take(5) // Get the latest 5 data
                ->get();

            return view('dashboard', compact('job_drafts'));
        } elseif ($user_role == 3) {
            $job_drafts = JobDraft::with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client'])
                ->where('content_writer_id', $user->id)
                ->orderBy('id', 'desc') // Sort by id descending
                ->take(5) // Get the latest 5 data
                ->get();

            return view('dashboard', compact('job_drafts'));
        } elseif ($user_role == 4) {
            $job_drafts = JobDraft::with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client'])
                ->where('graphic_designer', $user->id)
                ->orderBy('id', 'desc') // Sort by id descending
                ->take(5) // Get the latest 5 data
                ->get();

            return view('dashboard', compact('job_drafts'));
        } elseif ($user_role == 5) {
            $job_drafts = JobDraft::with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client'])
                ->where('top_manager', $user->id)
                ->orderBy('id', 'desc') // Sort by id descending
                ->take(5) // Get the latest 5 data
                ->get();

            return view('dashboard', compact('job_drafts'));
        }
    }
}

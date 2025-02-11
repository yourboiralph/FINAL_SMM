<?php

namespace App\Http\Controllers;

use App\Models\JobDraft;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $job_drafts = JobDraft::with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client'])
            ->orderBy('id', 'desc') // Sort by id descending
            ->take(5) // Get the latest 5 data
            ->get();

        return view('dashboard', compact('job_drafts'));
    }
}

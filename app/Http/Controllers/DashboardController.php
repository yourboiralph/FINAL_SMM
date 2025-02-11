<?php

namespace App\Http\Controllers;

use App\Models\JobDraft;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $job_drafts = JobDraft::where('status', 'Submitted to Operations')
            ->with(['jobOrder', 'contentWriter', 'graphicDesigner', 'client'])
            ->get();
        return view('dashboard', compact('job_drafts'));
    }
}

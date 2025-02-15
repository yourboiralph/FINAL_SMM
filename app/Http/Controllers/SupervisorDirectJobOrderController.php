<?php

namespace App\Http\Controllers;

use App\Models\JobDraft;
use App\Models\JobOrder;
use App\Models\User;
use Illuminate\Http\Request;

class SupervisorDirectJobOrderController extends Controller
{
    public function index()
    {
        $job_drafts = JobDraft::with('jobOrder', 'contentWriter', 'graphicDesigner')->get();
        return view('pages.supervisor.directjob.index', compact('job_drafts'));
    }

    public function create()
    {
        $users = User::with('role')->get();

        return view('pages/supervisor/directjob/create', compact('users'));
    }

    public function store(Request $request)
    {
        // Validate request before proceeding
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'content_writer_id' => 'required|integer',
            'graphic_designer_id' => 'required|integer',
            'client_id' => 'required|integer',
            'date_target' => 'required|date',
            'date_started' => 'required|date'
        ]);

        $job_order = JobOrder::create([
            'title' => $request->title,
            'description' => $request->description,
            'issued_by' => auth()->user()->id,
        ]);

        $job_draft = JobDraft::create([
            'job_order_id' => $job_order->id,
            'type' => 'content_writer',
            'date_started' => $request->date_started,
            'date_target' => $request->date_target,
            'status' => 'pending',
            'content_writer_id' => $request->content_writer_id,
            'graphic_designer_id' => $request->graphic_designer_id,
            'client_id' => $request->client_id,
        ]);

        return redirect()->route('joborder')->with('Status', 'Job Order Create Successfully');
    }
}

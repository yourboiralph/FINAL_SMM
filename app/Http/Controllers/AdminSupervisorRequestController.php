<?php

namespace App\Http\Controllers;

use App\Models\JobDraft;
use App\Models\JobOrder;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminSupervisorRequestController extends Controller
{
    public function index()
    {
        $supervisor_requests = ModelsRequest::where('assigned_to', auth()->user()->id)
            ->whereDoesntHave('jobOrders')
            ->whereDoesntHave('jobDrafts') // Ensure the request has no associated job drafts
            ->get();

        return view('pages.admin.supervisorRequest.index', compact('supervisor_requests'));
    }


    public function show($id)
    {
        $supervisor_request = ModelsRequest::find($id);
        return view('pages.admin.supervisorRequest.show', compact('supervisor_request'));
    }

    public function create($id)
    {
        $supervisor_request = ModelsRequest::find($id);

        $content_writers = User::where('role_id', 3)->get();
        $graphic_designers = User::where('role_id', 4)->get();
        $clients = User::where('role_id', 1)->get();

        return view('pages.admin.supervisorRequest.create', compact('content_writers', 'graphic_designers', 'clients', 'supervisor_request'));
    }

    public function store(Request $request, $id)
    {
        // Validate request before proceeding
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'content_writer_id' => 'required|integer',
            'graphic_designer_id' => 'required|integer',
            'client_id' => 'required|integer',
            'date_target' => 'required|date',
            'date_started' => 'required|date',
            'request_id' => 'required'
        ]);

        $job_order = JobOrder::create([
            'title' => $request->title,
            'description' => $request->description,
            'request_id' => $request->request_id,
            'issued_by' => auth()->user()->id,
        ]);

        JobDraft::create([
            'job_order_id' => $job_order->id,
            'type' => 'content_writer',
            'date_started' => $request->date_started,
            'date_target' => $request->date_target,
            'status' => 'pending',
            'content_writer_id' => $request->content_writer_id,
            'graphic_designer_id' => $request->graphic_designer_id,
            'client_id' => $request->client_id,
        ]);

        return redirect()->route('operation.request')->with('Status', 'Job Order Create Successfully');
    }
}

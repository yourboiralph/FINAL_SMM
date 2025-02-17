<?php

namespace App\Http\Controllers;

use App\Models\JobOrder;
use App\Models\Request as ModelsRequest; // Alias to avoid conflict
use App\Models\User;
use Illuminate\Http\Request;

class SupervisorJobOrderController extends Controller
{
    public function index()
    {
        $supervisor_requests = ModelsRequest::with('assignee')->get();
        return view('pages.supervisor.job_order.index', compact('supervisor_requests'));
    }

    public function create()
    {
        $operators = User::where('role_id', 2)->get();
        return view('pages.supervisor.job_order.create', compact('operators'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'assigned_to' => 'required|integer|exists:users,id',
        ]);

        ModelsRequest::create([ // Use ModelsRequest instead of Request
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'issued_by' => auth()->user()->id,
        ]);

        return redirect()->route('supervisor.joborder')->with('status', 'Job Order Created Successfully');
    }

    public function show($id)
    {
        $supervisor_request = ModelsRequest::with('issuer', 'assignee')->find(1);
        return view('pages.supervisor.job_order.show', compact('supervisor_request'));
    }

    public function edit($id)
    {
        $supervisor_request = ModelsRequest::with('issuer', 'assignee')->find(1);
        return view('pages.supervisor.job_order.edit', compact('supervisor_request'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
            'assigned_to' => 'sometimes|string',
        ]);

        $modelsrequest = ModelsRequest::find($id);

        $modelsrequest->update([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to
        ]);
    }
}

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
}

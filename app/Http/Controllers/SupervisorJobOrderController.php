<?php

namespace App\Http\Controllers;

use App\Models\JobOrder;
use App\Models\User;
use Illuminate\Http\Request;

class SupervisorJobOrderController extends Controller
{
    public function index()
    {
        $job_orders = JobOrder::with('issuer')->get();
        return view('pages.supervisor.job_order.index', compact('job_orders'));
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
            'assigned_to' => 'required|string',
        ]);

        JobOrder::create([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->description,
            'issued_by' => auth()->user()->id,
        ]);

        return redirect()->route('joborder')->with('Status', 'Job Order Create Successfully');
    }
}

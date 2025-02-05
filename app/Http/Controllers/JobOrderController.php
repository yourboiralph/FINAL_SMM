<?php

namespace App\Http\Controllers;

use App\Models\JobDraft;
use App\Models\JobOrder;
use App\Models\User;
use Illuminate\Http\Request;

class JobOrderController extends Controller
{
    public function index () {
        $job_orders = JobOrder::all();
        return view('pages/admin/joborder/joborder', compact('job_orders'));
    }
    public function create() {
        $content_writers = User::where('role', 3)->get();
        $graphic_designers = User::where('role', 4)->get();
        $clients = User::where('role', 1)->get();
    
        return view('pages.admin.joborder.create', compact('content_writers', 'graphic_designers', 'clients'));
    }
    public function store(Request $request) {
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
            'content_writer_id' => $request->content_writer_id,
            'graphic_designer_id' => $request->graphic_designer_id,
            'client_id' => $request->client_id,
            'issued_by' => auth()->user()->id,
        ]);

        $job_draft = JobDraft::create([
            'job_order_id' => $job_order->id,
            'type' => 'content_writer',
            'date_started' => $request->date_started,
            'date_target' => $request->date_target,
            'status' => 'new'
        ]);

        return redirect()->route('joborder.create')->with('status', 'Job Order Create Successfully');
    }

    public function show($id) {
        $job_order = JobOrder::findOrFail($id);
        return view('pages.admin.joborder.show', compact('job_order'));
    }
    
    public function edit($id) {
        $content_writers = User::where('role', 3)->get();
        $graphic_designers = User::where('role', 4)->get();
        $clients = User::where('role', 1)->get();
        $job_order = JobOrder::with('latest_job_draft')->find($id);
        return view('pages.admin.joborder.edit', compact('job_order', 'content_writers', 'graphic_designers', 'clients'));
    }
    public function update(Request $request, $id)
    {
        // Validate request before proceeding
        $request->validate([
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
            'content_writer_id' => 'sometimes|integer',
            'graphic_designer_id' => 'sometimes|integer',
            'client_id' => 'sometimes|integer',
            'date_target' => 'sometimes|date',
            'date_started' => 'sometimes|date'
        ]);

        // Find the job order by ID
        $job_order = JobOrder::findOrFail($id);
        
        // Update job order details
        $job_order->update([
            'title' => $request->title,
            'description' => $request->description,
            'content_writer_id' => $request->content_writer_id,
            'graphic_designer_id' => $request->graphic_designer_id,
            'client_id' => $request->client_id,
        ]);

        // Find the related job draft
        $job_draft = JobDraft::where('job_order_id', $job_order->id)->first();

        $job_draft->update([
            'date_started' => $request->date_started,
            'date_target' => $request->date_target,
        ]);
        

        return redirect()->route('joborder.edit', $id)->with('status', 'Job Order Updated Successfully');
    }

}

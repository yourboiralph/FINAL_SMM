<?php

namespace App\Http\Controllers;

use App\Models\JobDraft;
use App\Models\JobOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OperationRenewalController extends Controller
{
    public function index()
    {
        $job_orders = JobOrder::with('jobDrafts')->get();
        return view('pages.admin.renewal.index', compact('job_orders'));
    }

    public function update(Request $request, $id)
    {
        $jobOrder = JobOrder::find($id);

        if (!$jobOrder) {
            return response()->json(['success' => false, 'message' => 'Job Order not found'], 404);
        }

        // Update the renewable status
        $jobOrder->renewable = $request->input('renewable');
        $jobOrder->save();

        // Check if renewal is required
        if ($request->input('renewable')) {
            $jobDraft = JobDraft::where('job_order_id', $id)->orderBy('id', 'desc')->first();


            if (!$jobDraft) {
                return response()->json(['success' => false, 'message' => 'Job Draft not found'], 404);
            }

            if ($jobDraft->status == 'completed') {
                // Create a new JobDraft entry for renewal
                JobDraft::create([
                    'job_order_id' => $jobDraft->job_order_id,
                    'type' => 'content_writer',
                    'date_target' => Carbon::now()->addDays(3)->toDateString(),
                    'status' => 'pending',
                    'content_writer_id' => $jobDraft->content_writer_id,
                    'graphic_designer_id' => $jobDraft->graphic_designer_id,
                    'client_id' => $jobDraft->client_id,
                ]);
            }
        }
        return response()->json(['success' => true, 'message' => 'Job Order updated successfully']);
    }
}

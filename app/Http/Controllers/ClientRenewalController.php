<?php

namespace App\Http\Controllers;

use App\Models\JobDraft;
use App\Models\JobOrder;
use Illuminate\Http\Request;

class ClientRenewalController extends Controller
{
    public function index()
    {
        $job_orders = JobOrder::whereHas('jobDrafts', function ($query) {
            $query->where('client_id', auth()->user()->id);
        })->get();
        return view('pages.client.renewal.index', compact('job_orders'));
    }

    public function update(Request $request, $id)
    {
        dd($request->query('renewal')); // Should return 1 or 0
    }
}

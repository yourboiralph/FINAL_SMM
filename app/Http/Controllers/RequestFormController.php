<?php

namespace App\Http\Controllers;

use App\Models\Particular;
use App\Models\RequestForm;
use App\Models\User;
use Illuminate\Http\Request;

class RequestFormController extends Controller
{
    public function history()
    {
        $authuser = auth()->user();

        if ($authuser == '5') {
            dd($authuser);
        }
        $request_forms = RequestForm::all();
        $request_forms = RequestForm::where();

        return view('pages.admin.RequestForm.history', compact($request_forms));
    }

    public function create()
    {
        $users = User::all();

        return view('pages.admin.RequestForm.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'description' => 'required'
        ]);

        $request_form = RequestForm::create([
            'department' => auth()->user()->role_id,
            'date' => $request->date,
            'description' => $request->description,
            'requested_by' => auth()->user()->id,
            'manager_id' => $request->manager_id,
            'receiver_id' => $request->manager_id,
            'status' => 'Approved by Operation'
        ]);

        // Loop through the particulars and insert them
        foreach ($request->particulars as $particular) {
            Particular::create([
                'request_form_id' => $request_form->id,
                'particular' => $particular
            ]);
        }

        return redirect()->route('requestForm')->with('success', 'Request form created successfully.');
    }
}

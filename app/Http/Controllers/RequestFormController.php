<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RequestFormController extends Controller
{
    public function history()
    {
        return view('pages.admin.RequestForm.history');
    }

    public function create()
    {
        $users = User::all();

        return view('pages.admin.RequestForm.history', compact('users'));
    }

    public function store() {}
}

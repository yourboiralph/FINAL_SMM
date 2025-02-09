<?php

namespace App\Http\Controllers;

use App\Models\Revision;
use Illuminate\Http\Request;

class ContentRevisionController extends Controller
{
    public function index()
    {
        $revisions = Revision::with(['jobDraft' => function ($query) {
            $query->where('type', 'content_writer');
        }])
            ->whereHas('jobDraft', function ($query) {
                $query->where('content_writer_id', auth()->id())
                    ->where('status', 'Revision'); // Added status filter
            })
            ->get();

        return view('pages.content_writer.revision.index', compact('revisions'));
    }

    public function show($id) {}

    public function edit($id) {}

    public function update(Request $request, $id) {}
}

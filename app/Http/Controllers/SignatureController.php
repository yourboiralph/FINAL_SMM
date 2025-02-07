<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SignatureController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'signature' => 'required',
        ]);

        $image = $request->input('signature');
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = 'signature_' . time() . '.png';

        Storage::disk('public')->put("signatures/$imageName", base64_decode($image));

        return response()->json(['message' => 'Signature saved successfully!', 'path' => asset("storage/signatures/$imageName")]);
    }
}

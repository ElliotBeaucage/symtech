<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SignatureController extends Controller
{


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'signature' => 'required|string',
        ]);

        // Convertir base64 en image
        $data = $request->input('signature');
        $image = str_replace('data:image/png;base64,', '', $data);
        $image = str_replace(' ', '+', $image);
        $imageName = uniqid() . '.png';

        Storage::disk('public')->put("signatures/{$imageName}", base64_decode($image));

        Signature::create([
            'name' => $request->name,
            'image' => "signatures/{$imageName}",
        ]);

        return redirect()->back()->with('success', 'Signature enregistrée !');
    }
}


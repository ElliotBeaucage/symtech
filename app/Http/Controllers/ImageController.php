<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MachineImage;

class ImageController extends Controller
{
    public function store(Request $request)
{


    $request->validate([

        'images.*' => 'image|mimes:jpeg,png,jpg,gif,pdf|max:2048',
    ]);



    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imagePath = $image->store('images', 'public');

            $images = new MachineImage();

            $images->image = $imagePath;
            $images->save();
        }
    }

    return redirect()->back()->with('success', 'Machine et images ajoutées !');
}
}

<?php
namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\MachineImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MachineImageController extends Controller
{
    public function index($id)
    {
        $machine = Machine::with('images')->findOrFail($id);
        return view('machines.images', compact('machine'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'images.*' => 'image|mimes:jpeg,jpg,png,webp,heic,heif|max:20480'
        ]);

        foreach ($request->file('images') as $image) {
            $path = $image->store('machines', 'public');
            MachineImage::create([
                'machine_id' => $id,
                'image_path' => $path
            ]);
        }

        return back()->with('success', 'Images ajoutées avec succès.');
    }

    public function destroy($id)
    {
        $image = MachineImage::findOrFail($id);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Image supprimée.');
    }
}


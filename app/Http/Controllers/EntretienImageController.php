<?php

namespace App\Http\Controllers;

use App\Models\EntretienImage;
use Illuminate\Support\Facades\Storage;

class EntretienImageController extends Controller
{
    public function destroy($id)
    {
        $image = EntretienImage::findOrFail($id);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Image supprimée.');
    }
}

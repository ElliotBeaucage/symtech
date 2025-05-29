<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Building;
use App\Models\Entretien;
use App\Models\MachineImage;
use App\Models\EntretienImage;


use Illuminate\Support\Facades\Storage;

class EntretienController extends Controller
{
    public function index($buildings)
    {
        $building = Building::findOrFail($buildings);

        $entretiens = Entretien::where("building_id", $buildings)->get();

        // on va juste chercher toutes les images liées à ce building (ou toutes en général)
        $images = MachineImage::all(); // ou ->where(...) si tu veux filtrer par building

        return view("entretiens.index", [
            "entretiens" => $entretiens,
            "images" => $images,
            "buildings" => $building,

        ]);
    }
    public function create($buildings)
    {

        $building = Building::findOrFail($buildings)->id;



        return view("entretiens.create", [

            "buildings" => $building,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'f1' => 'nullable',
            'v1' => 'nullable',
            'v2' => 'nullable',
            'v3' => 'nullable',
            'v4' => 'nullable',
            'v5' => 'nullable',
            'v6' => 'nullable',
            'v7' => 'nullable',
            'v8' => 'nullable',
            'building_id' => 'required|exists:buildings,id',
            'signature' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        // Traitement de la signature
        $data = $request->input('signature');
        $image = str_replace('data:image/png;base64,', '', $data);
        $image = str_replace(' ', '+', $image);
        $imageName = uniqid() . '.png';

        Storage::disk('public')->put("signatures/{$imageName}", base64_decode($image));

        // Booléens
        $fields = ['f1', 'v1', 'v2', 'v3', 'v4', 'v5', 'v6', 'v7', 'v8'];
        $booleans = [];

        foreach ($fields as $field) {
            $booleans[$field] = $request->has($field); // true/false
        }

        // Création de l'entretien
        $entretien = Entretien::create(array_merge($booleans, [
            'user_id' => Auth::id(),
            'building_id' => $request->building_id,
            'description' => $request->description,
            'image' => "signatures/{$imageName}",
        ]));

        // Enregistrement des images si présentes
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                if ($img->isValid()) {
                    $path = $img->store('entretiens', 'public');
                    EntretienImage::create([
                        'entretien_id' => $entretien->id,
                        'image_path' => $path,
                    ]);
                }
            }
        }

        return redirect()->route('entretien.index', ['buildings' => $request->building_id])
            ->with('success', 'Entretien enregistré !');
    }


    public function edit($id)
{
    $entretien = Entretien::with('images')->findOrFail($id);
    $building = $entretien->building;

    return view('entretiens.edit', compact('entretien', 'building'));
}

public function update(Request $request, $id)
{
    $entretien = Entretien::findOrFail($id);

    $request->validate([
        'f1' => 'nullable',
        'v1' => 'nullable',
        'v2' => 'nullable',
        'v3' => 'nullable',
        'v4' => 'nullable',
        'v5' => 'nullable',
        'v6' => 'nullable',
        'v7' => 'nullable',
        'v8' => 'nullable',
        'description' => 'nullable|string',
        'images.*' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
    ]);

    // Booléens
    $fields = ['f1', 'v1', 'v2', 'v3', 'v4', 'v5', 'v6', 'v7', 'v8'];
    $booleans = [];

    foreach ($fields as $field) {
        $booleans[$field] = $request->has($field); // true/false
    }

    // Mise à jour de l'entretien
    $entretien->update(array_merge($booleans, [
        'description' => $request->description,
    ]));

    // Ajout des nouvelles images si présentes
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $img) {
            if ($img->isValid()) {
                $path = $img->store('entretiens', 'public');
                EntretienImage::create([
                    'entretien_id' => $entretien->id,
                    'image_path' => $path,
                ]);
            }
        }
    }

    return redirect()->route('entretien.index', ['buildings' => $entretien->building_id])
        ->with('success', 'Entretien mis à jour !');
}

public function destroy($id)
{
    $entretien = Entretien::findOrFail($id);
    $entretien->delete();

    return redirect()
        ->route("entretien.index", ["buildings" => $entretien->building_id])
        ->with("success", "L'entretien a été supprimé");
}



}

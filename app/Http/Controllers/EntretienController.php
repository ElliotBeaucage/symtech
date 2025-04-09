<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;
use App\Models\Entretien;
use App\Models\MachineImage;

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
            'building_id' => 'required|exists:buildings,id',
            'signature' => 'required|string',
        ]);

        // Traitement de la signature
        $data = $request->input('signature');
        $image = str_replace('data:image/png;base64,', '', $data);
        $image = str_replace(' ', '+', $image);
        $imageName = uniqid() . '.png';

        Storage::disk('public')->put("signatures/{$imageName}", base64_decode($image));

        // Booléens
        $fields = ['f1', 'v1', 'v2', 'v3', 'v4', 'v5'];
        $booleans = [];

        foreach ($fields as $field) {
            $booleans[$field] = $request->has($field); // true/false
        }

        // Sauvegarde en base
        Entretien::create(array_merge($booleans, [
            'building_id' => $request->building_id,
            'image' => "signatures/{$imageName}",
        ]));



        return redirect()->route('entretien.index', ['buildings' => $request->building_id])
        ->with('success', 'Entretien enregistré !');
    }
    public function edit($id)
{
    $entretien = Entretien::findOrFail($id);
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
    ]);

    $fields = ['f1', 'v1', 'v2', 'v3', 'v4', 'v5'];
    $booleans = [];

    foreach ($fields as $field) {
        $booleans[$field] = $request->has($field);
    }

    $entretien->update($booleans);

    return redirect()->route('entretien.index', ['buildings' => $entretien->building_id])
        ->with('success', 'Entretien mis à jour !');
}

public function destroy($id)
{
    $entretien = Entretien::findOrFail($id);
    $entretien->delete();

    return back()->with('success', 'Entretien supprimé.');
}


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;
use App\Models\Machine;
class MachineController extends Controller
{
    //

    public function index(Request $request, $buildings)
    {
        $search = $request->input('search');

        $machines = Machine::query()
            ->where("building_id", "=", $buildings); // Filter buildings by client_id

        if ($search) {
            $machines->where('nom', 'LIKE', "%{$search}%"); // Apply the search filter
        }

        return view("machines.index", [
            "machines" => $machines->get(), // Execute the query and get the results
            "buildings" => Building::findOrFail($buildings) // Retrieve the client or return a 404 if not found
        ]);
    }

    public function store(Request $request)
{
    dd($request->file('images'));

    $valid = $request->validate([
        "nom" => "max:255",
        "type" => "max:255",
        "marque" => "max:255",
        "modele" => "max:255",
        "serie" => "max:255",
        "courroie" => "max:255",
        "filtres" => "max:255",
        "freon" => "max:255",
        "desc" => "nullable|string",
        "image" => "nullable|mimes:jpeg,jpg,png,webp,heic,heif|max:20480",
        "buildings_id" => "required"
    ], [
        "buildings_id.required" => "Oups, il y a une erreur..."
    ]);

    $building_id = $valid["buildings_id"];

    $machine = new Machine();
    $machine->nom = $valid["nom"];
    $machine->type = $valid["type"];
    $machine->marque = $valid["marque"];
    $machine->modele = $valid["modele"];
    $machine->serie = $valid["serie"];
    $machine->courroie = $valid["courroie"];
    $machine->filtres = $valid["filtres"];
    $machine->freon = $valid["freon"];
    $machine->description = $valid["desc"];
    $machine->building_id = $building_id;




    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $machine->image = $request->file('image')->store('machines', 'public');
    }


    $machine->save();

    return redirect()
        ->route("machines.index", ['buildings' => $building_id])
        ->with("succes", "La machine a bien été créée");
}

    public function edit($id)
    {

        return view("machines.edit", [
            "machine" => Machine::findOrFail($id),
        ]);
    }
    public function update(Request $request)
    {

        $valid = $request->validate([
            "id" => "required",
            "nom" => "max:255",
            "type" => "max:255",
            "marque" => "max:255",
            "modele" => "max:255",
            "serie" => "max:255",
            "courroie" => "max:255",
            "filtres" => "max:255",
            "freon" => "max:255",
            "desc" => "",

        ], [
            "id.required" => "Un problème est survenu",
            "type.max" => "Il y a tros de caractère",
            "modele.max" => "Il y a tros de caractère",
            "serie.max" => "Il y a tros de caractère",
            "courroie.max" => "Il y a tros de caractère",
            "filttres.max" => "Il y a tros de caractère",
            "freon.max" => "Il y a tros de caractère",
        ]);


        $machine = Machine::findOrFail($valid["id"]);
        $machine->nom = $valid["nom"];
        $machine->type = $valid["type"];
        $machine->marque = $valid["marque"];
        $machine->modele = $valid["modele"];
        $machine->serie = $valid["serie"];
        $machine->courroie = $valid["courroie"];
        $machine->filtres = $valid["filtres"];
        $machine->freon = $valid["freon"];
        $machine->description = $valid["desc"];



        $machine->save();

        return redirect()
            ->route("machines.index", ["buildings" => $machine->building_id])
            ->with('success', "La machine a été modifiée");
    }

    public function destroy(Request $request)
    {
        $machine = Machine::findOrFail($request->id);
        Machine::destroy($machine->id);

        return redirect()
            ->route("machines.index", ["buildings" => $machine->building_id])
            ->with("success", "Le building a été supprimée");
    }
}

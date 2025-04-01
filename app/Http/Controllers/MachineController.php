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
            $machines->where('serie', 'LIKE', "%{$search}%"); // Apply the search filter
        }

        return view("machines.index", [
            "machines" => $machines->get(), // Execute the query and get the results
            "buildings" => Building::findOrFail($buildings) // Retrieve the client or return a 404 if not found
        ]);
    }

    public function store(Request $request)
    {


        $valid = $request->validate([

            "type" => "max:255",
            "marque" => "max:255",
            "modele" => "max:255",
            "serie" => "max:255",
            "courroie" => "max:255",
            "filtres" => "max:255",
            "freon" => "max:255",
            'buildings_id' => "required"

        ], [
            "buildings_id.required" => "oups il y a un erreur..."
        ]);
        $building_id =  $valid["buildings_id"];

        $machine = new Machine();
        $machine->type = $valid["type"];
        $machine->marque = $valid["marque"];
        $machine->modele = $valid["modele"];
        $machine->serie = $valid["serie"];
        $machine->courroie = $valid["courroie"];
        $machine->filtres = $valid["filtres"];
        $machine->freon = $valid["freon"];


        $machine->building_id = $building_id;



        $machine->save();

        return redirect()->route("machines.index",['buildings' =>$building_id])->with("succes", "Le building a bien été créée");
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
            "type" => "max:255",
            "marque" => "max:255",
            "modele" => "max:255",
            "serie" => "max:255",
            "courroie" => "max:255",
            "filtres" => "max:255",
            "freon" => "max:255",

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
        $machine->type = $valid["type"];
        $machine->marque = $valid["marque"];
        $machine->modele = $valid["modele"];
        $machine->serie = $valid["serie"];
        $machine->courroie = $valid["courroie"];
        $machine->filtres = $valid["filtres"];
        $machine->freon = $valid["freon"];



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

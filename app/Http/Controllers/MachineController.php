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
        $search = trim(strip_tags($request->input('search')));

        $machines = Machine::query()
            ->where("building_id", "=", $buildings);

        if ($search) {
            $machines->where('serie', 'LIKE', "%{$search}%");
        }

        return view("machines.index", [
            "machines" => $machines->get(),
            "buildings" => Building::findOrFail($buildings),
        ]);
    }

    public function store(Request $request)
    {


        $valid = $request->validate([

            "type" => "max:255",
            "marque" => "max:255",
            "modele" => "max:255",
            "serie" => "required|max:255",
            "courroie" => "max:255",
            "filtres" => "max:255",
            "freon" => "max:255",
            'buildings_id' => "required"

        ], [
            "serie.required" => "Le numéro de série est requis",
            "buildings_id.required" => "oups il y a un erreur..."
        ]);
        $building_id =  $valid["buildings_id"];

        $machine = new Machine();
        $machine->fill($valid);
        $machine->building_id = $valid['buildings_id'];
        $machine->save();

        return redirect()->route("machines.index", ['buildings' => $valid['buildings_id']])
                         ->with("success", "La machine a bien été créée");
    }
    public function edit(Machine $machine)
    {
        return view("machines.edit", compact('machine'));
    }

    public function update(Request $request, Machine $machine)
    {
        $valid = $request->validate([
            "type" => "required|max:255",
            "marque" => "required|max:255",
            "modele" => "required|max:255",
            "serie" => "required|max:255",
            "courroie" => "required|max:255",
            "filtres" => "required|max:255",
            "freon" => "required|max:255",
        ]);

        $machine->update($valid);

        return redirect()
            ->route("machines.index", ["buildings" => $machine->building_id])
            ->with('success', "La machine a été modifiée");
    }

    public function destroy(Machine $machine)
    {
        $machine->delete();

        return redirect()
            ->route("machines.index", ["buildings" => $machine->building_id])
            ->with("success", "La machine a été supprimée");
    }

}

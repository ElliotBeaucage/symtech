<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Client;
use Illuminate\Http\Request;

class buildingController extends Controller
{
    //
    public function index(Request $request, int $client)
    {
        $client = Client::findOrFail($client); // Ensure it's a valid client
        $search = $request->input('search');

        $buildings = Building::where("client_id", $client->id);

        if ($search) {
            $buildings->where('adresse', 'LIKE', "%{$search}%");
        }

        return view("buildings.index", [
            "buildings" => $buildings->get(),
            "client" => $client
        ]);
    }



    public function store(Request $request)
    {


        $valid = $request->validate([

            "name" => "required|max:255",
            'client_id' => "required"

        ], [
            "name.required" => "Le nom est requis",
            "client_id.required" => "oups il y a un erreur..."
        ]);
        $client_id =  $valid["client_id"];

        $building = new Building();
        $building->adresse = $valid["name"];
        $building->client_id = $client_id;
        $building->save();


        return redirect()->route("buildings.index",['client' =>$client_id])->with("succes", "Le building a bien été créée");
    }

    public function edit(Building $building)
    {
        return view("buildings.edit", compact("building"));
    }

    public function update(Request $request)
    {



        $valid = $request->validate([
            "id" => "required",
            "adresse" => "required",

        ], [
            "id.required" => "Un problème est survenu",
            "adresse.required" => "Le titre est requis",
        ]);


        $building = Building::findOrFail($valid["id"]);
        $building->adresse = $valid["adresse"];



        $building->save();

        return redirect()
            ->route("buildings.index", ["client" => $building->client_id])
            ->with('success', "Le building a été modifiée");
    }

    public function destroy(Request $request)
    {
        $building = Building::findOrFail($request->id);
        Building::destroy($building->id);

        return redirect()
        ->route("buildings.index", ["client" => $building->client_id])
        ->with("success", "Le building a été supprimé");

    }
}

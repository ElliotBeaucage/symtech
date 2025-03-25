<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Client;
use Illuminate\Http\Request;

class buildingController extends Controller
{
    //
    public function index(Request $request, $client)
    {
        $search = $request->input('search');

        $buildings = Building::query()
            ->where("client_id", "=", $client); // Filter buildings by client_id

        if ($search) {
            $buildings->where('adresse', 'LIKE', "%{$search}%"); // Apply the search filter
        }

        return view("buildings.index", [
            "buildings" => $buildings->get(), // Execute the query and get the results
            "client" => Client::findOrFail($client) // Retrieve the client or return a 404 if not found
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

        $buidling = new Building();
        $buidling->adresse = $valid["name"];

        $buidling->client_id = $client_id;



        $buidling->save();

        return redirect()->route("buildings.index",['client' =>$client_id])->with("succes", "Le building a bien été créée");
    }
    public function edit($id)
    {

        return view("buildings.edit", [
            "building" => Building::findOrFail($id),
        ]);
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
            ->route("buidlings.index")
            ->with("success", "Le building a été supprimée");
    }
}

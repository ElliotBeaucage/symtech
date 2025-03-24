<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //

    public function index(Request $request)
    {

        $search = $request->input('search');
        $clients = Client::query();

        if ($search) {
            $clients->where('name', 'LIKE', "%{$search}%");
        }

        return view('clients.index', ['clients' => $clients->get()]);
    }

    public function store(Request $request)
    {
        $valid = $request->validate([
            "name" => "required|max:255",

        ], [
            "name.required" => "Le nom est requis",
        ]);
        $client = new Client();
        $client->name = $valid["name"];

        $client->save();

        return redirect()->route("clients.index")->with("succes", "Le client a bien été créée");
    }
    public function edit($id)
    {

        return view("clients.edit", [

            "client" => Client::findOrFail($id),
        ]);
    }
    public function update(Request $request)
    {



        $valid = $request->validate([
            "id" => "required",
            "name" => "required",

        ], [
            "id.required" => "Un problème est survenu",
            "name.required" => "Le titre est requis",
        ]);


        $client = Client::findOrFail($valid["id"]);
        $client->name = $valid["name"];



        $client->save();

        return redirect()
            ->route("clients.index")
            ->with('success', "Le client a été modifiée");
    }

    public function destroy(Request $request)
    {
        $client = Client::findOrFail($request->id);
        Client::destroy($client->id);

        return redirect()
            ->route("clients.index")
            ->with("success", "Le client a été supprimée");
    }
}

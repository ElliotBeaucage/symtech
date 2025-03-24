<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //

    public function index(Request $request)
{
    $search = trim(strip_tags($request->input('search')));
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
    public function edit(Client $client)
{
    return view("clients.edit", compact("client"));
}

public function update(Request $request, Client $client)
{
    $valid = $request->validate([
        "name" => "required|max:255",
    ], [
        "name.required" => "Le titre est requis",
    ]);

    $client->update([
        "name" => $valid["name"],
    ]);

    return redirect()
        ->route("clients.index")
        ->with('success', "Le client a été modifié");
}


public function destroy(Client $client)
{
    $client->delete();

    return redirect()
        ->route("clients.index")
        ->with("success", "Le client a été supprimé");
}

}

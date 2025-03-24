<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnexionController extends Controller
{
    //
    public function index()
    {
        return view("index");
    }



    public function auth(Request $request)
    {

        // Validate login data
        $valid = $request->validate([
            "username" => "required",
            "password" => "required|min:8",
        ], [
            "username.required" => "Le nom de l'employé est requis",
            "password.required" => "Le mot de passe est requis.",
            "password.min" => "Le mot de passe doit contenir au moins 8 caractères.",
        ]);



        if (! Auth::attempt($valid)) {
            return back()
                ->with('error', "Les informations fournies sont incorrectes. Veuillez réessayer.");
        }


        // Regenerate the session to prevent attacks
        $request->session()->regenerate();


        $user = Auth::user();

        return redirect()->route("clients.index")
            ->with('success', "Bienvenue" .  $user->username);
    }
}

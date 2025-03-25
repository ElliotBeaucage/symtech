<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnexionController extends Controller
{
    //
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('clients.index'); // Redirige si l'utilisateur est connecté
        }

        return view("index");
    }

    public function auth(Request $request)
    {

        // Validate login data
        $valid = $request->validate([
            "username" => "required",
            "password" => "required"
        ], [
            "username.required" => "Le nom de l'employer est requis",
            "password.required" => "Le mot de passe est requis."
        ]);


        // Attempt to authenticate
        if (! Auth::attempt($valid)) {
            return back()
                ->with('error', "Les informations fournies sont invalides. Réessayez.");
        }

        // Regenerate the session to prevent attacks
        $request->session()->regenerate();


        $user = Auth::user();

        return redirect()->route("clients.index")
            ->with('success', "Bienvenue" .  $user->username);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnexionController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('clients.index'); // Redirige si l'utilisateur est déjà connecté
        }

        return view("index"); // Formulaire de connexion
    }

    public function auth(Request $request)
    {
        // Validation
        $credentials = $request->validate([
            "username" => "required",
            "password" => "required"
        ], [
            "username.required" => "Le nom de l'employé est requis.",
            "password.required" => "Le mot de passe est requis."
        ]);

        // Vérifie si l'utilisateur veut être "remembered"
        $remember = $request->has('remember');

        // Tentative de connexion avec remember me
        if (!Auth::attempt($credentials, $remember)) {
            return back()->with('error', "Les informations fournies sont invalides. Réessayez.");
        }

        // Sécurise la session
        $request->session()->regenerate();

        $user = Auth::user();

        return redirect()->route("clients.index")
            ->with('success', "Bienvenue " . $user->username);
    }
}

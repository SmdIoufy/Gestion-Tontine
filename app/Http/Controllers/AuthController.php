<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create() {
        return view('pages.auth.auth');
    }

    public function auth(Request $request) {
        $auth = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($auth)) {
            $request->session()->regenerate();

        if (Auth::attempt($auth)) {
            $request->session()->regenerate();

            $user = Auth::user();
            switch ($user->profil) {
                case 'SUPER_ADMIN':
                    return redirect()->route('super_admin.dashboard')->with('success', 'Connexion réussie.');
                case 'GERANT':
                    return redirect()->route('gerant.dashboard')->with('success', 'Connexion réussie.');
                case 'PARTICIPANT':
                    return redirect()->route('participant.dashboard')->with('success', 'Connexion réussie.');
                default:
                    return redirect()->route('home')->with('success', 'Connexion réussie.');
            }
        }
        }

        return back()->with('error', "Email et/ou Mot de passe incorrect");
    }
}




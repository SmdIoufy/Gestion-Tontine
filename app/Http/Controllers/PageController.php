<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function cgu()
    {
        return view('cgu');
    }

    public function confidentialite()
    {
        return view('confidentialite');
    }

    public function contrat()
    {
        return view('contrat');
    }

    public function aPropos()
    {
        return view('a_propos');
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendContact(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        // Mail::to('admin@example.com')->send(new ContactForm($request->all()));

        return redirect()->route('contact')->with('success', 'Votre message a été envoyé avec succès.');
    }

    public function faq()
    {
        return view('faq');
    }
}

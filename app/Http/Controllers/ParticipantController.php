<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Auth;
use App\Models\Cotisation;
use App\Models\Paiement;
use App\Models\Tontine;

class ParticipantController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('auth.create')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        $tontines = Tontine::count();
        $cotisations = Cotisation::sum('montant');
        $paiements = Paiement::sum('montant');

        // Récupérer les tontines avec les images
        $tontines = Tontine::with('participants', 'images')->get();

        $tontinesDisponibles = Tontine::whereDoesntHave('participants', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->with('images')->get();

        $tontinesParticipees = Tontine::whereHas('participants', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->with('images')->get();

        return view('dashboards.participant', compact('tontines', 'cotisations', 'paiements', 'tontinesDisponibles', 'tontinesParticipees'));
    }

}

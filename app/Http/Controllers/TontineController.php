<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tontine;

class TontineController extends Controller
{
    public function index()
    {
        $tontines = Tontine::all();
        return view('tontines.index', compact('tontines'));
    }

    public function create()
    {
        return view('tontines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Tontine::create($request->all());

        return redirect()->route('tontines.index');
    }

    public function show(Tontine $tontine)
    {
        $tours = $tontine->tours()->with('beneficiaire')->get();

        return view('tontines.show', compact('tontine', 'tours'));
    }

    //lancer un tiragge
    public function lancerTirage(Tontine $tontine)
        {
            if (now()->lt($tontine->dateDebut) || now()->gt($tontine->dateFin)) {
                return redirect()->back()->withErrors('La tontine n\'est pas active.');
            }

            $tourActuel = $tontine->tours()->whereNull('beneficiaire_id')->first();

            if (!$tourActuel) {
                return redirect()->back()->withErrors('Tous les tours ont déjà un bénéficiaire.');
            }

            $participantsEligibles = $tontine->participants()->whereDoesntHave('tours', function ($query) use ($tontine) {
                $query->where('tontine_id', $tontine->id);
            })->get();

            if ($participantsEligibles->isEmpty()) {
                return redirect()->back()->withErrors('Aucun participant éligible pour ce tour.');
            }

            $beneficiaire = $participantsEligibles->random();

            $tourActuel->update(['beneficiaire_id' => $beneficiaire->id]);

            return redirect()->route('tontines.show', $tontine->id)->with('success', "Le tirage a été effectué avec succès. Le bénéficiaire est {$beneficiaire->name}.");
        }


    public function edit(Tontine $tontine)
    {
        return view('tontines.edit', compact('tontine'));
    }

    public function update(Request $request, Tontine $tontine)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $tontine->update($request->all());

        return redirect()->route('tontines.index');
    }

    public function destroy(Tontine $tontine)
    {
        $tontine->delete();

        return redirect()->route('tontines.index');
    }

    public function join(Request $request, Tontine $tontine)
    {
        $user = Auth::user();
        try {
            $tontine->participants()->attach($user->id);
            return redirect()->route('participant.dashboard')->with('success', 'Vous avez rejoint la tontine avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('participant.dashboard')->with('error', 'Une erreur est survenue. Veuillez réessayer.');
        }
    }

    public function quit(Request $request, Tontine $tontine)
    {
        $user = Auth::user();
        try {
            $tontine->participants()->detach($user->id);
            return redirect()->route('participant.dashboard')->with('success', 'Vous avez quitté la tontine avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('participant.dashboard')->with('error', 'Une erreur est survenue. Veuillez réessayer.');
        }
    }
}

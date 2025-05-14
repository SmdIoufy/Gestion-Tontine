<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use PDF;
use App\Models\Cotisation;
use App\Models\Tontine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CotisationController extends Controller
{
    public function index()
        {
            $cotisations = Paiement::with('user')->latest()->paginate(10);
            $membresEnRetard = Paiement::where('status', 'en_retard')->get();
            $paiements = Paiement::with(['user', 'cotisation.tontine'])->latest()->paginate(10);

            return view('cotisations.index', compact('cotisations', 'membresEnRetard', 'paiements'));
        }

    public function genererRecu($id)
        {
            $paiement = Paiement::findOrFail($id);
            $pdf = PDF::loadView('cotisations.recu', compact('paiement'));

            return $pdf->download('recu-paiement-' . $paiement->id . '.pdf');
        }

    public function create()
    {
        $tontines = Tontine::all();
        return view('cotisations.create', compact('tontines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idTontine' => 'required',
            'montant' => 'required|numeric|min:1000',
            'moyen_paiement' => 'required|string|in:ESPECES,WAVE,OM',
        ]);

        try {
            Cotisation::create([
                'idUser' => auth()->id(),
                'idTontine' => $request->idTontine,
                'montant' => $request->montant,
                'moyen_paiement' => $request->moyen_paiement,
            ]);

            // Notifier l'utilisateur du succès du paiement
            Session::flash('success', 'Le paiement a été effectué avec succès.');

        } catch (\Exception $e) {
            // Notifier l'utilisateur de l'échec du paiement
            Session::flash('error', 'Une erreur s\'est produite lors du paiement. Veuillez réessayer.');
        }

        return redirect()->route('cotisations.create');
    }

    public function edit(Cotisation $cotisation)
    {
        $tontines = Tontine::all();
        return view('cotisations.edit', compact('cotisation', 'tontines'));
    }

    public function update(Request $request, Cotisation $cotisation)
    {
        $request->validate([
            'idTontine' => 'required',
            'montant' => 'required|numeric',
            'moyen_paiement' => 'required|string',
        ]);

        $cotisation->update($request->all());
        return redirect()->route('cotisations.index')->with('success', 'Cotisation mise à jour avec succès.');
    }

    public function destroy(Cotisation $cotisation)
    {
        $cotisation->delete();
        return redirect()->route('cotisations.index')->with('success', 'Cotisation supprimée avec succès.');
    }
}

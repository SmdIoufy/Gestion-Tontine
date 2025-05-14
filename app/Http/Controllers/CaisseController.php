<?php

namespace App\Http\Controllers;
use App\Models\Paiement;


use Illuminate\Http\Request;

class CaisseController extends Controller
{
    public function details()
    {
        $solde = Paiement::where('status', 'termine')->sum('montant');

        $transactions = Paiement::where('status', 'termine')
            ->latest()
            ->get();
        return view('caisse.details', compact('solde', 'transactions'));
    }

}

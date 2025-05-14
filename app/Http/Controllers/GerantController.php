<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Paiement;
use App\Models\Tontine;
use App\Models\User;
use App\Models\Image;

class GerantController extends Controller
{
    /**
     * Affichage du tableau de bord du gérant
     */
    public function index()
    {
        // Statistiques clés
        $nombreMembres = User::count();
        $montantTotalCotise = Paiement::where('status', 'termine')->sum('montant');
        $montantTotalDistribue = Tontine::sum('montant_distribue');

        // Gestion des tontines
        $tontines = Tontine::orderBy('dateFin', 'asc')->get();
        $tontineActuelle = Tontine::where('dateFin', '>=', now())->orderBy('dateFin', 'asc')->first();
        $prochaineTontine = Tontine::where('dateDebut', '>', now())->orderBy('dateDebut', 'asc')->first();

        // Évolution des montants collectés (pour les graphiques)
        $montantsParMois = Paiement::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as mois, SUM(montant) as total')
            ->groupBy('mois')
            ->orderBy('mois')
            ->pluck('total', 'mois');

        // Répartition des fréquences des tontines
        $frequenceStats = $tontines->groupBy('frequence')->map->count();

        // Paiements récents
        $recentPayments = Paiement::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Transactions récentes
        $transactions = Paiement::orderBy('date_paiement', 'desc')
            ->limit(10)
            ->get();

        // Membres
        $membres = User::withCount(['paiements as retards' => function ($query) {
            $query->where('status', 'en_retard');
        }])->get();

        // Membres en retard
        $membresEnRetard = Paiement::where('status', 'en_retard')->pluck('idUser');

        // Tours de tontine (bénéficiaires)
        $tours = Tontine::with('beneficiaire')
            ->orderBy('dateFin', 'asc')
            ->limit(10)
            ->get();

        // Prochaines échéances
        $tourActuel = Tontine::where('dateFin', '>=', now())
            ->orderBy('dateFin', 'asc')
            ->first();

        $prochaineEcheance = Tontine::where('dateFin', '>', now())
            ->orderBy('dateFin', 'asc')
            ->skip(1)
            ->first();

        // Évolution des montants collectés
        $montantsParMois = Paiement::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as mois, SUM(montant) as total')
            ->groupBy('mois')
            ->orderBy('mois')
            ->pluck('total', 'mois');

        $montantsLabels = $montantsParMois->keys()->toArray(); // Mois
        $montantsValues = $montantsParMois->values()->toArray(); // Totaux

        // Répartition des tontines par fréquence
        $tontines = Tontine::all();
        $frequenceStats = $tontines->groupBy('frequence')->map->count();
        $frequenceLabels = ['Journalières', 'Hebdomadaires', 'Mensuelles'];
        $frequenceValues = [
            $frequenceStats['JOURNALIERE'] ?? 0,
            $frequenceStats['HEBDOMADAIRE'] ?? 0,
            $frequenceStats['MENSUELLE'] ?? 0,
        ];

        return view('dashboards.gerant.gerant', compact(
            'nombreMembres',
            'montantTotalCotise',
            'montantTotalDistribue',
            'tontineActuelle',
            'prochaineTontine',
            'montantsParMois',
            'frequenceStats',
            'recentPayments',
            'membresEnRetard',
            'transactions',
            'tours',
            'tourActuel',
            'prochaineEcheance',
            'tontines',
            'membres',
            'montantsLabels',
            'montantsValues',
            'frequenceLabels',
            'frequenceValues',
        ));
    }

    /**
     * Enregistrement d'une nouvelle tontine
     */
    public function creer(){
        return view('dashboards.gerant.gerant_creer_tontine');
    }

    public function enregistrer(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:191',
            'frequence' => 'required|in:JOURNALIERE,HEBDOMADAIRE,MENSUELLE',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date|after_or_equal:dateDebut',
            'montant_de_base' => 'required|numeric|min:0',
            'montant_total' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'nbreParticipant' => 'required|integer|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $tontine = Tontine::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $nomImage = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                $imagePath = $image->storeAs('tontines', $nomImage, 'public');

                Image::create([
                    'idTontine' => $tontine->id,
                    'nomImage' => $nomImage,
                ]);
            }
        }

        return redirect()->route('gerant.index')->with('success', 'Tontine créée avec succès.');
    }

    /**
     * Mise à jour d'une tontine
     */
    public function mettreAJour(Request $request, Tontine $tontine)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:191',
            'frequence' => 'required|in:JOURNALIERE,HEBDOMADAIRE,MENSUELLE',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date|after_or_equal:dateDebut',
            'montant_de_base' => 'required|numeric|min:2000',
            'montant_total' => 'required|numeric|min:1000',
            'description' => 'nullable|string',
            'nbreParticipant' => 'required|integer|min:2',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $tontine->update($validated);

        // Gestion des nouvelles images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $nomImage = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('tontines', $nomImage, 'public');

                $tontine->images()->create([
                    'nomImage' => $nomImage,
                ]);
            }
        }

        return redirect()->route('gerant.index')->with('success', 'Tontine mise à jour avec succès.');
    }

    public function modifier($id)
{
    $tontine = Tontine::findOrFail($id);

    return view('dashboards.gerant.gerant_modifier_tontine', compact('tontine'));
}

    /**
     * Suppression d'une tontine
     */
    public function supprimer(Tontine $tontine)
    {
        foreach ($tontine->images as $image) {
            Storage::disk('public')->delete('tontines/' . $image->nomImage);

            $image->delete();
        }

        $tontine->delete();

        return redirect()->route('gerant.index')->with('success', 'Tontine supprimée avec succès.');
    }

    /**
     * Suppression d'une image associée à une tontine
     */
    public function supprimerImage($id)
    {
        $image = Image::findOrFail($id);

        Storage::disk('public')->delete('tontines/' . $image->nomImage);

        $image->delete();

        return back()->with('success', 'Image supprimée avec succès.');
    }

    public function afficherTirages()
        {
            $tontines = Tontine::with(['participants', 'tirages'])
                ->get()
                ->filter(function ($tontine) {
                    return $this->frequenceAtteinte($tontine) &&
                        $tontine->participants->whereNotIn(
                            'id',
                            $tontine->tirages->pluck('idbeneficiaire')->toArray()
                        )->isNotEmpty();
                });

            return view('dashboards.gerant.tirages', compact('tontines'));
        }
        /**
     * Lancer un tirage pour une tontine.
     */

     public function lancerTirage($idtontine)
     {
         $tontine = Tontine::with(['participants', 'tirages'])->findOrFail($idtontine);

         if (!$this->frequenceAtteinte($tontine)) {
             return redirect()->back()->with('error', 'La fréquence de la tontine n\'est pas encore atteinte.');
         }

         $participantsEligibles = $tontine->participants->whereNotIn(
             'id',
             $tontine->tirages->pluck('idbeneficiaire')->toArray()
         );

         if ($participantsEligibles->isEmpty()) {
             return redirect()->back()->with('error', 'Tous les participants ont déjà bénéficié d\'un tirage.');
         }

         $beneficiaire = $participantsEligibles->random();

         $tirage = Tirage::create([
             'idtontine' => $tontine->id,
             'idbeneficiaire' => $beneficiaire->id,
             'date_tirage' => now(),
         ]);

         Notification::send($tontine->participants, new TirageNotification($tontine, $beneficiaire));

         return redirect()->route('gerant.tirages')->with('success', 'Le tirage a été effectué avec succès. Le gagnant est ' . $beneficiaire->name);
     }

    /**
     * Vérifier si la fréquence d'une tontine est atteinte.
     */
    private function frequenceAtteinte($tontine)
    {
        $derniereTirage = $tontine->tirages->last();
        $dateDerniereTirage = $derniereTirage ? $derniereTirage->date_tirage : $tontine->date_creation;

        switch ($tontine->frequence) {
            case 'journalier':
                return now()->diffInDays($dateDerniereTirage) >= 1;
            case 'hebdomadaire':
                return now()->diffInWeeks($dateDerniereTirage) >= 1;
            case 'mensuel':
                return now()->diffInMonths($dateDerniereTirage) >= 1;
            default:
                return false;
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Tontine;
use App\Models\Participant;
use App\Models\Cotisation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PayTechService;

class PaiementController extends Controller
{
    public function index()
    {
        $tontines = Tontine::all();
        $paiements = Paiement::with('cotisation', 'user')->get();
        return view('paiements.index', compact('paiements', 'tontines'));
    }

    public function create($idTontine)
        {
            $cotisations = Cotisation::all();
            $users = User::all();
            $tontine = Tontine::findOrFail($idTontine); // Récupérer la tontine par son ID
            return view('paiements.create', compact('cotisations', 'users', 'tontine')); // Transmettre les données à la vue
        }

        public function store(Request $request)
        {
            $request->validate([
                'idTontine' => 'required|exists:tontines,id',
                'montant' => 'required|numeric|min:1',
                'moyen_paiement' => 'required|string|in:Orange Money,Wave,Espèce',
            ]);

            $tontine = Tontine::findOrFail($request->idTontine);

            $participant = $tontine->participants()->where('user_id', Auth::id())->first();
            if (!$participant) {
                return redirect()->route('paiements.create', ['idTontine' => $tontine->id])
                    ->withErrors('Vous ne participez pas à cette tontine.');
            }
                    $paiement = Paiement::create([
                'idTontine' => $tontine->id,
                'idParticipant' => $participant->id,
                'idUser' => Auth::id(),
                'montant' => $request->montant,
                'moyen_paiement' => $request->moyen_paiement,
                'status' => $request->moyen_paiement === 'Espèce' ? 'en_attente' : 'termine',
                'date_paiement' => now(),
            ]);

            if ($request->moyen_paiement === 'Espèce') {
                $path = $request->file('preuve')->store('preuves-paiements', 'public');
                $paiement->preuve = $path;
                $paiement->save();
            }

            return redirect()->route('paiements.index')->with('success', 'Paiement enregistré avec succès.');
        }

        public function handleNotify(Request $request)
            {
                // Log des données reçues de PayTech pour débogage
                \Log::info('Notification PayTech reçue', $request->all());

                // Vérifiez si les données nécessaires sont présentes
                if (!$request->has(['status', 'amount', 'payment_method'])) {
                    return response()->json(['message' => 'Données invalides fournies.'], 400);
                }

                $status = $request->input('status');
                $amount = $request->input('amount');
                $paymentMethod = $request->input('payment_method');
                $transactionId = $request->input('transaction_id');
                $customField = $request->input('custom_field', []);

                // Vérifiez si le paiement a été validé
                if ($status === 'completed') {
                    Paiement::create([
                        'montant' => $amount,
                        'moyen_paiement' => $paymentMethod,
                        'transaction_id' => $transactionId,
                        'date_paiement' => now(),
                        'status' => 'completed',
                    ]);

                    return response()->json(['message' => 'Paiement enregistré avec succès.']);
                }

                return response()->json(['message' => 'Paiement non confirmé.'], 400);
            }
    public function handleSuccess()
    {
        return redirect()->route('dashboard')->with('success', 'Paiement effectué avec succès.');
    }

    public function handleCancel()
    {
        return redirect()->route('paiements.create')->with('error', 'Le paiement a été annulé.');
    }

    public function details()
        {
            $solde = Paiement::where('status', 'termine')->sum('montant');

            $transactions = Paiement::where('status', 'termine')
                ->latest()
                ->get();
            return view('caisse.details', compact('solde', 'transactions'));
        }

        public function afficherFormulaire($idTontine)
            {
                $tontine = Tontine::findOrFail($idTontine); // Récupérer la tontine concernée
                return view('paiements.create', compact('tontine'));
            }

        public function afficherFormulaireSimulation()
        {
            $cotisations = Cotisation::all();
            return view('paiements.simulation', compact('cotisations'));
        }

        public function simulerPaiement(Request $request)
        {
            $request->validate([
                'idCotisation' => 'required|exists:cotisations,id',
                'montant' => 'required|numeric|min:1',
            ]);

            $cotisation = Cotisation::findOrFail($request->idCotisation);

            if ($cotisation->idUser !== Auth::id()) {
                return redirect()->route('paiements.simulation')->withErrors('Vous ne pouvez simuler un paiement que pour vos propres cotisations.');
            }

            $paiement = Paiement::create([
                'idCotisation' => $cotisation->id,
                'montant' => $request->montant,
                'moyen_paiement' => 'Simulation',
                'status' => 'en_attente',
                'date_paiement' => now(),
            ]);

            $paiement->status = $this->genererStatutSimulation();
            $paiement->save();

            return redirect()->route('paiements.simulation')
                ->with('status', $paiement->status === 'termine' ? 'Paiement simulé avec succès !' :
                    ($paiement->status === 'echoue' ? 'La simulation a échoué.' : 'La simulation a été annulée.'));
        }

        private function genererStatutSimulation()
        {
            $statuts = ['termine', 'echoue', 'annule'];
            return $statuts[array_rand($statuts)];
        }

        public function afficherHistorique()
        {
            $paiements = Paiement::where('moyen_paiement', 'Simulation')
                ->latest()
                ->get();

            return view('paiements.historique', compact('paiements'));
        }

        public function effectuerPaiement(Request $request)
            {
                $request->validate([
                    'idCotisation' => 'required|exists:cotisations,id',
                    'montant' => 'required|numeric|min:1',
                    'moyen_paiement' => 'required|string|in:Orange Money,Wave,Espèce',
                ]);

                $cotisation = Paiement::findOrFail($request->idCotisation);
                $participant = $cotisation->participant;

                if ($request->moyen_paiement === 'Espèce' && !$request->hasFile('preuve')) {
                    return redirect()->back()->withErrors('Veuillez fournir une preuve pour le paiement en espèces.');
                }

                if ($request->moyen_paiement !== 'Espèce' && $participant->solde < $request->montant) {
                    return redirect()->back()->withErrors('Solde insuffisant pour effectuer ce paiement.');
                }

                if ($request->moyen_paiement !== 'Espèce') {
                    $participant->solde -= $request->montant;
                    $participant->save();
                }

                $paiement = Paiement::create([
                    'idCotisation' => $cotisation->id,
                    'idParticipant' => $participant->id,
                    'montant' => $request->montant,
                    'moyen_paiement' => $request->moyen_paiement,
                    'status' => $request->moyen_paiement === 'Espèce' ? 'en_attente' : 'termine',
                    'date_paiement' => now(),
                ]);

                if ($request->moyen_paiement === 'Espèce') {
                    $path = $request->file('preuve')->store('preuves-paiements', 'public');
                    $paiement->preuve = $path;
                    $paiement->save();
                }

                return redirect()->route('paiements.index')->with('success', 'Paiement enregistré avec succès.');
            }


}

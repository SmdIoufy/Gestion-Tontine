@extends('layouts.app')

@section('contenu')
<div class="container">
    <h1>Détails de la Caisse</h1>

    <!-- Affichage du solde actuel -->
    <div class="card mb-4">
        <div class="card-body">
            <h3>Solde Total : <strong>{{ number_format($solde, 2, ',', ' ') }} FCFA</strong></h3>
        </div>
    </div>

    <!-- Liste des transactions -->
    <div class="card">
        <div class="card-header">
            <h4>Transactions</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Participant</th>
                        <th>Montant</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaction->date_paiement)->format('d/m/Y') }}</td>                            <td>{{ $transaction->participant->nom ?? 'N/A' }}</td>
                            <td>{{ number_format($transaction->montant, 2, ',', ' ') }} FCFA</td>
                            <td>
                                <span class="badge bg-success">Payé</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Aucune transaction enregistrée pour la caisse.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

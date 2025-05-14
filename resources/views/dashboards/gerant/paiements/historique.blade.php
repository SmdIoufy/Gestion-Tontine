@extends('layouts.app')

@section('title', 'Historique des Paiements Simulés')

@section('contenu')
<div class="container">
    <h1 class="mb-4">Historique des Paiements Simulés</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Cotisation</th>
                <th>Montant</th>
                <th>Moyen de Paiement</th>
                <th>Statut</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($paiements as $paiement)
            <tr>
                <td>{{ $paiement->id }}</td>
                <td>{{ $paiement->cotisation->libelle }}</td>
                <td>{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</td>
                <td>{{ $paiement->moyen_paiement }}</td>
                <td>
                    <span class="badge bg-{{
                        $paiement->status === 'termine' ? 'success' :
                        ($paiement->status === 'echoue' ? 'danger' : 'warning')
                    }}">
                        {{ ucfirst($paiement->status) }}
                    </span>
                </td>
                <td>{{ $paiement->date_paiement->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Aucun paiement simulé trouvé.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

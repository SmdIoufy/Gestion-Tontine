@extends('layouts.app')

@section('title', 'Gestion des Paiements')

@section('contenu')
<div class="container">
    <h1 class="mb-4">Gestion des Paiements</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Participant</th>
                <th>Tontine</th>
                <th>Montant</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($paiements as $paiement)
                <tr>
                    <td>{{ $paiement->id }}</td>
                    <td>{{ $paiement->participant ? $paiement->participant->nom : 'N/A' }}</td>
                    <td>{{ $paiement->tontine ? $paiement->tontine->libelle : 'N/A' }}</td>
                    <td>{{ $paiement->montant }}</td>
                    <td>
                        @if($paiement->statut == 'valide')
                            <span class="badge bg-success">Validé</span>
                        @elseif($paiement->statut == 'annule')
                            <span class="badge bg-danger">Annulé</span>
                        @else
                            <span class="badge bg-warning">En attente</span>
                        @endif
                    </td>
                    <td>
                        @if($paiement->statut == 'en attente')
                            <form action="{{ route('gerant.paiements.valider', $paiement->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Valider</button>
                            </form>
                            <form action="{{ route('gerant.paiements.annuler', $paiement->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Annuler</button>
                            </form>
                        @else
                            <span class="text-muted">Aucune action disponible</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Aucun paiement disponible.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des Paiements</h1>
    @foreach ($tontines as $tontine)
    <a href="{{ route('paiements.create', ['idTontine' => $tontine->id]) }}" class="btn btn-primary mb-3">
        Ajouter un Paiement
    </a>
@endforeach
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cotisation</th>
                <th>Utilisateur</th>
                <th>Montant</th>
                <th>Date de Paiement</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paiements as $paiement)
                <tr>
                    <td>{{ $paiement->id }}</td>
                    <td>{{ $paiement->cotisation->tontine->nom }}</td>
                    <td>{{ $paiement->user->name }}</td>
                    <td>{{ $paiement->montant }}</td>
                    <td>{{ $paiement->date_paiement }}</td>
                    <td>
                        <a href="{{ route('paiements.edit', $paiement->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('paiements.destroy', $paiement->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

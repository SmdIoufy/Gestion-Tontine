@extends('layouts.app')

@section('title', 'Simulation de Paiement')

@section('contenu')
<div class="container">
    <h1 class="mb-4">Simuler un Paiement</h1>

    @if(session('status'))
        <div class="alert alert-info">{{ session('status') }}</div>
    @endif

    <form action="{{ route('paiements.simuler') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="idCotisation" class="form-label">Choisir une cotisation</label>
            <select name="idCotisation" id="idCotisation" class="form-select" required>
                <option value="">-- Sélectionnez une cotisation --</option>
                @foreach($cotisations as $cotisation)
                    <option value="{{ $cotisation->id }}">{{ $cotisation->libelle }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="montant" class="form-label">Montant à payer (FCFA)</label>
            <input type="number" name="montant" id="montant" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Simuler le paiement</button>
    </form>
</div>
@endsection

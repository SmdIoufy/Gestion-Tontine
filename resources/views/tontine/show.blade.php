@extends('layouts.app')

@section('contenu')
<div class="container">
    <h1 class="mb-4">{{ $tontine->nom }}</h1>
    <p>{{ $tontine->description }}</p>
    <p>Montant: {{ $tontine->montant }}€</p>
    <p>Fréquence: {{ $tontine->frequence }}</p>

    <form action="{{ route('tontines.join', $tontine->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="moyen_paiement" class="form-label">Moyen de Paiement</label>
            <input type="text" class="form-control" id="moyen_paiement" name="moyen_paiement" required>
        </div>
        <button type="submit" class="btn btn-primary">Rejoindre</button>
    </form>
</div>
@endsection

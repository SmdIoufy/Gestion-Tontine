@extends('layouts.app')

@section('contenu')
<div class="container">
    <h1 class="mb-4">Tontines</h1>
    <div class="row">
        @foreach($tontines as $tontine)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $tontine->nom }}</h5>
                        <p class="card-text">{{ $tontine->description }}</p>
                        <p class="card-text">Montant: {{ $tontine->montant }}€</p>
                        <p class="card-text">Fréquence: {{ $tontine->frequence }}</p>
                        <a href="{{ route('tontines.show', $tontine->id) }}" class="btn btn-primary">Voir</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

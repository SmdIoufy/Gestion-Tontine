@extends('layouts.app')

@section('contenu')
<div class="container">
    <h1 class="mb-4">Tirages à effectuer</h1>

    @if($tontines->isEmpty())
        <p class="text-muted">Aucune tontine n'est prête pour un tirage.</p>
    @else
        @foreach($tontines as $tontine)
            <div class="card mb-3">
                <div class="card-header">
                    <h5>{{ $tontine->libelle }}</h5>
                </div>
                <div class="card-body">
                    <p>Fréquence : {{ ucfirst($tontine->frequence) }}</p>

                    <ul>
                        @foreach($tontine->tirages as $tirage)
                            <li>
                                Tirage effectué le {{ $tirage->date_tirage->format('d/m/Y') }} :
                                <strong>{{ $tirage->beneficiaire->name }}</strong>
                            </li>
                        @endforeach
                    </ul>

                    <form action="{{ route('gerant.tirages.lancer', $tontine->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Lancer le tirage</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Résultat du tirage</h1>
    <p>Le gagnant de la tontine <strong>{{ $tontine->name }}</strong> est <strong>{{ $gagnant->name }}</strong>.</p>
</div>
@endsection

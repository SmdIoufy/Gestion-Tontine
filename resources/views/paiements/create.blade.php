@extends('layouts.app')

@section('title', 'Effectuer un Paiement')

@section('contenu')
<div class="container">
    <h1 class="mb-4">Effectuer un Paiement pour la Tontine : {{ $tontine->nom }}</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('paiements.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf

        <!-- Champ caché pour inclure l'ID de la tontine -->
        <input type="hidden" name="idTontine" value="{{ $tontine->id }}">

        <div class="mb-3">
            <label for="montant" class="form-label">Montant à payer (FCFA)</label>
            <input type="number" name="montant" id="montant" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label for="moyen_paiement" class="form-label">Moyen de Paiement</label>
            <select name="moyen_paiement" id="moyen_paiement" class="form-select" required>
                <option value="Orange Money">Orange Money</option>
                <option value="Wave">Wave</option>
                <option value="Espèce">Espèce</option>
            </select>
        </div>

        <div class="mb-3 d-none" id="upload-preuve-container">
            <label for="preuve" class="form-label">Preuve de Paiement</label>
            <input type="file" name="preuve" id="preuve" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
        </div>

        <button type="submit" class="btn btn-primary">Effectuer le paiement</button>
    </form>
</div>

<script>
    document.getElementById('moyen_paiement').addEventListener('change', function () {
        const proofContainer = document.getElementById('upload-preuve-container');
        if (this.value === 'Espèce') {
            proofContainer.classList.remove('d-none');
        } else {
            proofContainer.classList.add('d-none');
        }
    });
</script>
@endsection

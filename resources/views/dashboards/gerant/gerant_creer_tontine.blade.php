@extends('layouts.app')

@section('contenu')
<div class="container-fluid p-4">
    <h1 class="h4 text-primary mb-4">Créer une nouvelle tontine</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('gerant.enregistrer') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="libelle" class="form-label">Libellé</label>
                    <input type="text" name="libelle" id="libelle" class="form-control" placeholder="Nom de la tontine" required>
                </div>
                <div class="mb-3">
                    <label for="frequence" class="form-label">Fréquence</label>
                    <select name="frequence" id="frequence" class="form-control" required>
                        <option value="" disabled selected>Choisir une fréquence</option>
                        <option value="JOURNALIERE">Journalière</option>
                        <option value="HEBDOMADAIRE">Hebdomadaire</option>
                        <option value="MENSUELLE">Mensuelle</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="dateDebut" class="form-label">Date de début</label>
                    <input type="date" name="dateDebut" id="dateDebut" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="dateFin" class="form-label">Date de fin</label>
                    <input type="date" name="dateFin" id="dateFin" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="montant_de_base" class="form-label">Montant de base</label>
                    <input type="number" name="montant_de_base" id="montant_de_base" class="form-control" placeholder="Montant de base en FCFA" required>
                </div>
                <div class="mb-3">
                    <label for="montant_total" class="form-label">Montant total</label>
                    <input type="number" name="montant_total" id="montant_total" class="form-control" placeholder="Montant total en FCFA" required>
                </div>
                <div class="mb-3">
                    <label for="nbreParticipant" class="form-label">Nombre de participants</label>
                    <input type="number" name="nbreParticipant" id="nbreParticipant" class="form-control" placeholder="Nombre de participants" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3" placeholder="Ajouter une description (facultatif)"></textarea>
                </div>
                <div class="mb-3">
                    <label for="images" class="form-label">Images</label>
                    <input type="file" name="images[]" id="images" class="form-control" multiple>
                    <small class="text-muted">Vous pouvez ajouter plusieurs images (JPEG, PNG, JPG, GIF, max 2Mo par image).</small>
                </div>
                <button type="submit" class="btn btn-primary w-100">Créer la tontine</button>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('contenu')
<div class="container-fluid p-4">
    <!-- En-tête amélioré -->
    <div class="d-flex align-items-center gap-3 mb-4">
        <i class="fas fa-edit fa-2x text-primary"></i>
        <h1 class="h3 text-primary mb-0 fw-bold">Modifier la tontine</h1>
    </div>

    <div class="card border-0 shadow-lg">
        <div class="card-body p-4">
            <form action="{{ route('gerant.update', $tontine->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <!-- Section Principale -->
                <div class="row g-4">
                    <!-- Colonne Gauche -->
                    <div class="col-lg-6">
                        <!-- Libellé -->
                        <div class="mb-4">
                            <label for="libelle" class="form-label fw-semibold">Libellé <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary-subtle"><i class="fas fa-tag text-primary"></i></span>
                                <input type="text" name="libelle" id="libelle"
                                       class="form-control shadow-sm"
                                       value="{{ $tontine->libelle }}"
                                       required>
                            </div>
                        </div>

                        <!-- Fréquence -->
                        <div class="mb-4">
                            <label for="frequence" class="form-label fw-semibold">Fréquence <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary-subtle"><i class="fas fa-sync-alt text-primary"></i></span>
                                <select name="frequence" id="frequence" class="form-select shadow-sm" required>
                                    <option value="JOURNALIERE" {{ $tontine->frequence === 'JOURNALIERE' ? 'selected' : '' }}>Journalière</option>
                                    <option value="HEBDOMADAIRE" {{ $tontine->frequence === 'HEBDOMADAIRE' ? 'selected' : '' }}>Hebdomadaire</option>
                                    <option value="MENSUELLE" {{ $tontine->frequence === 'MENSUELLE' ? 'selected' : '' }}>Mensuelle</option>
                                </select>
                            </div>
                        </div>

                        <!-- Dates -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="dateDebut" class="form-label fw-semibold">Date de début <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary-subtle"><i class="fas fa-calendar-start text-primary"></i></span>
                                    <input type="date" name="dateDebut" id="dateDebut"
                                           class="form-control shadow-sm"
                                           value="{{ $tontine->dateDebut->format('Y-m-d') }}"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="dateFin" class="form-label fw-semibold">Date de fin <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary-subtle"><i class="fas fa-calendar-day text-primary"></i></span>
                                    <input type="date" name="dateFin" id="dateFin"
                                           class="form-control shadow-sm"
                                           value="{{ $tontine->dateFin->format('Y-m-d') }}"
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Colonne Droite -->
                    <div class="col-lg-6">
                        <!-- Montants -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="montant_de_base" class="form-label fw-semibold">Montant de base <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary-subtle">FCFA</span>
                                    <input type="number" name="montant_de_base" id="montant_de_base"
                                           class="form-control shadow-sm"
                                           value="{{ $tontine->montant_de_base }}"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="montant_total" class="form-label fw-semibold">Montant total <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary-subtle">FCFA</span>
                                    <input type="number" name="montant_total" id="montant_total"
                                           class="form-control shadow-sm"
                                           value="{{ $tontine->montant_total }}"
                                           required>
                                </div>
                            </div>
                        </div>

                        <!-- Nombre de participants -->
                        <div class="mb-4">
                            <label for="nbreParticipant" class="form-label fw-semibold">Participants <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary-subtle"><i class="fas fa-users text-primary"></i></span>
                                <input type="number" name="nbreParticipant" id="nbreParticipant"
                                       class="form-control shadow-sm"
                                       value="{{ $tontine->nbreParticipant }}"
                                       required>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea name="description" id="description"
                                      class="form-control shadow-sm"
                                      rows="4"
                                      placeholder="Décrivez les spécificités de cette tontine...">{{ $tontine->description }}</textarea>
                            <small class="text-muted">Max. 500 caractères</small>
                        </div>
                    </div>
                </div>

                <!-- Galerie d'images -->
                <div class="border-top pt-4 mt-4">
                    <!-- Images existantes -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Galerie actuelle</label>
                        <div class="d-flex flex-wrap gap-4">
                            @foreach($tontine->images as $image)
                                <div class="position-relative image-card">
                                    <img src="{{ asset('images/' . $image->nomImage) }}"
                                         alt="Image de la tontine"
                                         class="rounded-3 shadow-sm object-fit-cover"
                                         style="width: 120px; height: 120px;">
                                    <a href="{{ route('gerant.image.supprimer', $image->id) }}"
                                       class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle shadow-sm image-delete"
                                       title="Supprimer cette image"
                                       onclick="return confirm('Voulez-vous vraiment supprimer cette image ?')">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Ajout d'images -->
                    <div class="mb-4">
                        <label for="images" class="form-label fw-semibold">Ajouter des images</label>
                        <div class="file-upload-area border rounded-3 p-4 text-center bg-light-subtle">
                            <input type="file" name="images[]"
                                   id="images"
                                   class="form-control"
                                   multiple
                                   accept="image/*"
                                   onchange="previewNewImages(event)">
                            <div class="mt-3 text-muted small">
                                <i class="fas fa-info-circle me-2"></i>
                                Formats acceptés : JPEG, PNG, JPG, GIF • Max. 2Mo par image
                            </div>
                            <div id="new-images-preview" class="d-flex flex-wrap gap-3 mt-3"></div>
                        </div>
                    </div>
                </div>

                <!-- Boutons de soumission -->
                <div class="d-flex justify-content-end gap-3 mt-5">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4">
                        <i class="fas fa-arrow-left me-2"></i>Annuler
                    </a>
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.image-card {
    transition: transform 0.2s ease;
}

.image-card:hover {
    transform: translateY(-3px);
}

.file-upload-area {
    border: 2px dashed #dee2e6;
    transition: border-color 0.3s ease;
}

.file-upload-area:hover {
    border-color: #0d6efd;
    background: rgba(13, 110, 253, 0.05);
}

.image-delete {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0.8;
}

.image-delete:hover {
    opacity: 1;
}

.object-fit-cover {
    object-fit: cover;
}

.needs-validation .form-control:invalid {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220,53,69,.25);
}
</style>

<script>
function previewNewImages(event) {
    const preview = document.getElementById('new-images-preview');
    preview.innerHTML = '';

    Array.from(event.target.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = (e) => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'rounded-2 shadow-sm object-fit-cover';
            img.style.width = '100px';
            img.style.height = '100px';
            preview.appendChild(img);
        }
        reader.readAsDataURL(file);
    });
}
</script>
@endsection

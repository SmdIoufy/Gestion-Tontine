@extends('layouts.app')

@section('contenu')
<div class="container mt-5 mb-4">
    <h1 class="display-4 text-center mb-5 gradient-text">
        Tableau de Bord
    </h1>

    <!-- Section Tontines disponibles -->
    <section class="mb-5">
        <h2 class="h3 fw-bold mb-4 border-start border-4 border-primary ps-3 bg-light py-2 rounded-end">
            Tontines disponibles 🌟
        </h2>
        <div class="row">
            @foreach($tontinesDisponibles as $tontine)
                <div class="col-12 col-md-6 col-xl-3 mb-4">
                    <div class="card custom-card card-hover">
                        <div class="position-relative overflow-hidden" style="height: 200px;">
                            <img src="{{ $tontine->images->first() ? asset('storage/images/' . $tontine->images->first()->nomImage) : asset('storage/images/default.jpg') }}"
                                class="card-img-top img-fluid"
                                alt="Illustration tontine">
                            <div class="img-overlay"></div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-white p-2 rounded-circle shadow-sm me-3">
                                    <span style="font-size: 1.5rem;">💰</span>
                                </div>
                                <h5 class="card-title mb-0">{{ $tontine->nom }}</h5>
                            </div>
                            <p class="card-text text-muted small">{{ $tontine->description }}</p>
                            <div class="mb-3">
                                <div class="d-flex align-items-center bg-light border rounded p-2 mb-2">
                                    <i class="fas fa-coins text-primary me-2"></i>
                                    <span class="fw-medium text-primary">{{ $tontine->montant }} FCFA</span>
                                </div>
                                <div class="d-flex align-items-center bg-light border rounded p-2">
                                    <i class="fas fa-sync-alt text-primary me-2"></i>
                                    <span class="fw-medium text-secondary">{{ $tontine->frequence }}</span>
                                </div>
                            </div>
                            <form action="{{ route('tontines.join', $tontine->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100 btn-gradient">
                                    <i class="fas fa-user-plus me-2"></i> Rejoindre
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Section Tontines participées -->
    <section>
        <h2 class="h3 fw-bold mb-4 border-start border-4 border-success ps-3 bg-light py-2 rounded-end">
            Mes participations 🛡️
        </h2>
        <div class="row">
            @foreach($tontinesParticipees as $tontine)
                <div class="col-12 col-md-6 col-xl-3 mb-4">
                    <div class="card custom-card card-hover">
                        <div class="position-relative overflow-hidden" style="height: 200px;">
                            <img src="{{ $tontine->images->first() ? asset('storage/images/' . $tontine->images->first()->nomImage) : asset('storage/images/default.jpg') }}"
                                class="card-img-top img-fluid"
                                alt="Illustration tontine">
                            <div class="active-badge">Actif ✅</div>
                            <div class="img-overlay"></div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-white p-2 rounded-circle shadow-sm me-3">
                                    <span style="font-size: 1.5rem;">🏦</span>
                                </div>
                                <h5 class="card-title mb-0">{{ $tontine->nom }}</h5>
                            </div>
                            <p class="card-text text-muted small">{{ $tontine->description }}</p>
                            <div class="mb-3">
                                <div class="d-flex align-items-center bg-light border rounded p-2 mb-2">
                                    <i class="fas fa-coins text-success me-2"></i>
                                    <span class="fw-medium text-success">{{ $tontine->montant }} FCFA</span>
                                </div>
                                <div class="d-flex align-items-center bg-light border rounded p-2">
                                    <i class="fas fa-sync-alt text-success me-2"></i>
                                    <span class="fw-medium text-secondary">{{ $tontine->frequence }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <form action="{{ route('tontines.quit', $tontine->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir quitter cette tontine ? Vous laisserez vos gains et ne serez pas remboursé.');">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100 btn-gradient mb-2">
                                        <i class="fas fa-sign-out-alt me-2"></i> Quitter
                                    </button>
                                </form>
                                <a href="{{ route('paiements.create', ['idTontine' => $tontine->id]) }}" class="btn btn-success w-100 btn-gradient text-center">
                                    <i class="fas fa-credit-card me-2"></i> Payer
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>

<!-- Styles personnalisés pour recréer les effets Tailwind -->
<style>
    /* Gradient text pour l'en-tête */
    .gradient-text {
        background: -webkit-linear-gradient(45deg, #2563eb, #8b5cf6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    /* Style personnalisé de la carte avec fond dégradé */
    .custom-card {
        border: 1px solid #cfe2ff;
        border-radius: 1rem;
        overflow: hidden;
        background: linear-gradient(135deg, #e7f1ff, #ffffff);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
    }
    /* Overlay d'image pour effet dégradé */
    .img-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to top, rgba(37,99,235,0.2), transparent);
    }
    /* Badge indiquant l'état actif */
    .active-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: #198754;
        color: #fff;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.8rem;
        box-shadow: 0 0.2rem 0.5rem rgba(0,0,0,0.1);
        z-index: 2;
    }
    /* Effet de zoom sur l'image lors du survol */
    .card-hover img {
        transition: transform 0.3s ease;
    }
    .card-hover:hover img {
        transform: scale(1.05);
    }
    /* Effet de survol pour les boutons */
    .btn-gradient {
        transition: transform 0.3s ease;
    }
    .btn-gradient:hover {
        transform: scale(1.02);
    }
</style>
@endsection

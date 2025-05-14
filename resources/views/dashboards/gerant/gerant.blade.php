@extends('layouts.app')

@section('contenu')
<div class="container-fluid p-4 bg-light-subtle">
    <!-- En-tête avec design moderne -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 p-4 bg-white rounded-4 shadow-sm border border-light">
        <div>
            <h1 class="display-5 mb-0 text-primary fw-bold">
                <i class="fas fa-tachometer-alt me-2 fa-fw"></i>Tableau de bord
            </h1>
            <p class="text-muted mb-0 mt-2 opacity-75">Gestion des tontines en temps réel</p>
        </div>
        <div class="d-flex gap-3">
            <a href="{{ route('gerant.creer') }}" class="btn btn-primary btn-lg px-4 py-3 shadow-sm hover-lift">
                <i class="fas fa-plus-circle me-2"></i>Nouvelle tontine
            </a>
            <a href="{{ route('notifications.create') }}" class="btn btn-outline-primary btn-lg px-4 py-3 shadow-sm hover-lift">
                <i class="fas fa-bell me-2"></i>Créer notification
            </a>
            <a href="{{ route('gerant.tirages') }}" class="btn btn-primary btn-lg px-4 py-3 shadow-sm hover-lift">
                <i class="fas fa-random me-2"></i>Gérer les Tirages
            </a>
        </div>
    </div>

    <!-- Statistiques avec design amélioré -->
    <div class="row g-4 mb-4">
        @foreach([
            ['icon' => 'users', 'color' => 'primary', 'label' => 'Membres', 'value' => $nombreMembres],
            ['icon' => 'hand-holding-usd', 'color' => 'success', 'label' => 'Cotisations', 'value' => number_format($montantTotalCotise, 0, ',', ' ') . ' FCFA'],
            ['icon' => 'share-alt', 'color' => 'info', 'label' => 'Distributions', 'value' => number_format($montantTotalDistribue, 0, ',', ' ') . ' FCFA'],
            ['icon' => 'exclamation-triangle', 'color' => 'danger', 'label' => 'En retard', 'value' => count($membresEnRetard)],
        ] as $stat)
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 transition-all hover-lift">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-gradient-{{ $stat['color'] }}-subtle p-3 rounded-4">
                            <i class="fas fa-{{ $stat['icon'] }} fa-2x text-{{ $stat['color'] }}"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="text-muted small mb-1">{{ $stat['label'] }}</div>
                            <div class="h3 mb-0 fw-bold text-dark">{{ $stat['value'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Graphiques avec style raffiné -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3 d-flex align-items-center">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="fas fa-chart-line me-2"></i>Évolution des montants
                    </h5>
                </div>
                <div class="card-body p-3 ratio ratio-16x9">
                    <canvas id="montantsChart" class="chart-entrance"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3 d-flex align-items-center">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="fas fa-chart-pie me-2"></i>Répartition des tontines
                    </h5>
                </div>
                <div class="card-body p-3 ratio ratio-16x9">
                    <canvas id="frequenceChart" class="chart-entrance"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-8">
            <!-- Tableau des transactions  -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h3 class="h5 mb-0 fw-bold text-primary">
                        <i class="fas fa-clock me-2"></i>Dernières transactions
                    </h3>
                    <a href="{{ route('cotisations.index') }}" class="btn btn-sm btn-outline-primary hover-lift">
                        Voir tout <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 border-bottom-0 small">Membre</th>
                                    <th class="py-3 border-bottom-0 small">Montant</th>
                                    <th class="py-3 border-bottom-0 small">Date</th>
                                    <th class="py-3 border-bottom-0 small">Statut</th>
                                    <th class="py-3 border-bottom-0 small text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentPayments as $paiement)
                                <tr class="hover-lift">
                                    <td class="fw-medium">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar-sm bg-primary-subtle text-primary rounded-2">
                                                <i class="fas fa-user fa-sm"></i>
                                            </div>
                                            {{ $paiement->user->name }}
                                        </div>
                                    </td>
                                    <td class="text-success fw-bold">{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</td>
                                    <td><span class="badge bg-light text-dark border">{{ $paiement->created_at->format('d/m/Y') }}</span></td>
                                    <td>
                                    <span class="badge rounded-pill bg-{{
                                        $paiement->status === 'termine' ? 'success-subtle' :
                                        ($paiement->status === 'en attente' ? 'warning-subtle' :
                                        ($paiement->status === 'annule' ? 'secondary-subtle' : 'danger-subtle')) }}
                                        text-{{ $paiement->status === 'termine' ? 'success' :
                                        ($paiement->status === 'en_attente' ? 'warning' :
                                        ($paiement->status === 'annule' ? 'secondary' : 'danger')) }}
                                        d-flex align-items-center gap-1">
                                        <i class="fas fa-{{
                                            $paiement->status === 'termine' ? 'check-circle' :
                                            ($paiement->status === 'en_attente' ? 'exclamation-circle' :
                                            ($paiement->status === 'annule' ? 'ban' : 'times-circle')) }} fa-xs"></i>
                                        {{ ucfirst($paiement->status) }}
                                    </span>

                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex gap-2 justify-content-end">
                                            <a href="{{ route('cotisations.recu', $paiement->id) }}"
                                               class="btn btn-sm btn-outline-secondary rounded-circle hover-lift"
                                               data-bs-toggle="tooltip"
                                               title="Générer reçu">
                                                <i class="fas fa-receipt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="fas fa-info-circle me-2"></i>Aucune transaction récente
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Liste des tontines avec améliorations visuelles -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h3 class="h5 mb-0 fw-bold text-primary">
                        <i class="fas fa-list me-2"></i>Tontines actives
                    </h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 border-bottom-0 small">Libellé</th>
                                    <th class="py-3 border-bottom-0 small">Fréquence</th>
                                    <th class="py-3 border-bottom-0 small">Dates</th>
                                    <th class="py-3 border-bottom-0 small text-end">Montant</th>
                                    <th class="py-3 border-bottom-0 small text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tontines as $tontine)
                                <tr class="hover-lift">
                                    <td class="fw-medium">{{ $tontine->libelle }}</td>
                                    <td>
                                        <span class="badge bg-info-subtle text-info rounded-pill d-inline-flex align-items-center gap-1">
                                            <i class="fas fa-history fa-xs"></i>
                                            {{ ucfirst(strtolower($tontine->frequence)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <small class="text-muted">Début: {{ $tontine->dateDebut->format('d/m/Y') }}</small>
                                            <small class="text-muted">Fin: {{ $tontine->dateFin->format('d/m/Y') }}</small>
                                        </div>
                                    </td>
                                    <td class="text-end fw-bold text-primary">
                                        {{ number_format($tontine->montant_total, 0, ',', ' ') }} FCFA
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex gap-2 justify-content-end">
                                            <a href="{{ route('gerant.modifier', $tontine->id) }}"
                                               class="btn btn-sm btn-outline-primary rounded-circle hover-lift"
                                               data-bs-toggle="tooltip"
                                               title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('gerant.supprimer', $tontine->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger rounded-circle hover-lift"
                                                        data-bs-toggle="tooltip"
                                                        title="Supprimer"
                                                        onclick="return confirm('Confirmer la suppression ?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="fas fa-info-circle me-2"></i>Aucune tontine active
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <!-- Panneau des échéances -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h3 class="h5 mb-0 fw-bold text-primary">
                        <i class="fas fa-calendar-alt me-2"></i>Prochaines étapes
                    </h3>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center py-3 px-0 border-bottom">
                            <div>
                                <div class="fw-medium">Tour actuel</div>
                                <small class="text-muted">{{ $tourActuel?->beneficiaire?->name ?? 'En attente' }}</small>
                            </div>
                            <div class="text-end">
                                <div class="text-primary fw-medium">{{ $tourActuel?->dateFin?->format('d/m') ?? '-' }}</div>
                                <small class="text-muted">Échéance</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- trésorerie  -->
            <div class="card border-0 shadow-sm mt-4 bg-gradient-primary text-white">
                <div class="card-header bg-transparent border-bottom py-3">
                    <h3 class="h5 mb-0 fw-bold">
                        <i class="fas fa-cash-register me-2"></i>Trésorerie
                    </h3>
                </div>
                <div class="card-body text-center">
                    <div class="display-5 fw-bold mb-3">
                        {{ number_format($montantTotalCotise - $montantTotalDistribue, 0, ',', ' ') }} <small class="fs-6 opacity-75">FCFA</small>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="{{ route('caisse.details') }}"
                           class="btn btn-outline-light btn-sm hover-lift">
                            <i class="fas fa-search-dollar me-2"></i>Détails complets
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Configuration des graphiques
    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: { font: { size: 14 } }
            }
        },
        animation: {
            duration: 1500,
            easing: 'easeOutQuart'
        }
    };

    // Graphique linéaire
    new Chart(document.getElementById('montantsChart'), {
        type: 'line',
        data: {
            labels: @json($montantsLabels),
            datasets: [{
                label: 'Montants Collectés (FCFA)',
                data: @json($montantsValues),
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                tension: 0.4,
                borderWidth: 2
            }]
        },
        options: chartOptions
    });

    // Graphique camembert
    new Chart(document.getElementById('frequenceChart'), {
        type: 'pie',
        data: {
            labels: @json($frequenceLabels),
            datasets: [{
                data: @json($frequenceValues),
                backgroundColor: ['#DAA520', '#A52A2A', '#C2A378'],
                borderWidth: 0
            }]
        },
        options: chartOptions
    });

    // Activation des tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.forEach(tooltipTriggerEl => {
        new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

<style>
/* Personnalisations esthétiques */
.card {
    border-radius: 0.75rem;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.hover-lift:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.1)!important;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
}

.avatar-sm {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chart-entrance {
    animation: chart-entrance 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
}

@keyframes chart-entrance {
    0% { opacity: 0; transform: scale(0.95); }
    100% { opacity: 1; transform: scale(1); }
}
</style>
@endsection

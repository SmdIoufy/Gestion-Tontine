@extends('layouts.app')

@section('title', 'Créer une Notification')

@section('contenu')
<div class="container py-4">
    <div class="row g-4">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary bg-gradient text-white py-3">
                    <h2 class="h5 mb-0">
                        <i class="fas fa-bell me-2"></i>Nouvelle Notification
                    </h2>
                </div>

                <div class="card-body">
                    <form action="{{ route('notifications.store') }}" method="POST">
                        @csrf

                        <!-- Sélection des destinataires -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Destinataires</label>
                            <select class="form-select" id="recipientType" name="recipient_type" required>
                                <option value="">Choisir le type de destinataires</option>
                                <option value="specific">Sélection manuelle</option>
                                <option value="all_participants">Tous les participants</option>
                                <option value="treasurer">Trésoriers</option>
                                <option value="admin">Administrateurs</option>
                                <option value="all_users">Tous les utilisateurs</option>
                            </select>
                        </div>

                        <!-- Sélection manuelle -->
                        <div class="mb-4 collapse" id="userSelection">
                            <label class="form-label fw-semibold">Choisir les utilisateurs</label>
                            <div class="form-check">
                                @foreach($users as $user)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="recipients[]" value="{{ $user->id }}" id="user{{ $user->id }}">
                                    <label class="form-check-label" for="user{{ $user->id }}">
                                        {{ $user->full_name }} ({{ ucfirst($user->profil) }})
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Détails de la notification -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Titre</label>
                            <input type="text" class="form-control" name="title" placeholder="Sujet de la notification" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Message</label>
                            <textarea class="form-control" name="message" rows="4" placeholder="Contenu de votre message..." required></textarea>
                        </div>

                        <!-- Niveau de priorité -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Priorité</label>
                            <div class="d-grid gap-2 d-md-block">
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="priority" id="low" value="low" checked>
                                    <label class="btn btn-outline-success" for="low">
                                        <i class="fas fa-check-circle me-2"></i>Normale
                                    </label>

                                    <input type="radio" class="btn-check" name="priority" id="medium" value="medium">
                                    <label class="btn btn-outline-warning" for="medium">
                                        <i class="fas fa-exclamation-triangle me-2"></i>Importante
                                    </label>

                                    <input type="radio" class="btn-check" name="priority" id="high" value="high">
                                    <label class="btn btn-outline-danger" for="high">
                                        <i class="fas fa-bell me-2"></i>Urgente
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between border-top pt-4">
                            <a href="{{ route('notifications.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Retour
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>Envoyer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Panneau des destinataires -->
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-info bg-gradient text-white py-3">
                    <h3 class="h5 mb-0">
                        <i class="fas fa-users me-2"></i> Destinataires sélectionnés
                    </h3>
                </div>
                <div class="card-body">
                    <!-- Barre de recherche -->
                    <input type="text" id="searchUser" class="form-control mb-3"
                        placeholder="Rechercher un utilisateur...">

                    <div id="recipientPreview" class="d-flex flex-column gap-2">
                        @foreach($users as $user)
                            <div class="user-card card shadow-sm border-0 mb-3">
                                <div class="card-body p-3 d-flex align-items-center gap-3">
                                    <!-- Case à cocher améliorée -->
                                    <input class="form-check-input border border-primary user-checkbox"
                                        type="checkbox"
                                        value="{{ $user->id }}"
                                        id="user-{{ $user->id }}"
                                        style="width: 1.5rem; height: 1.5rem; cursor: pointer;">

                                    <!-- Icône utilisateur Font Awesome -->
                                    <label class="d-flex align-items-center gap-3 flex-grow-1"
                                        for="user-{{ $user->id }}">
                                        <i class="fas fa-user-circle text-secondary"
                                        style="font-size: 2.5rem;"></i>

                                        <div>
                                            <div class="fw-bold text-primary user-name">{{ $user->full_name }}</div>
                                            <small class="text-muted user-profile">{{ $user->profil }}</small>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Script de filtrage -->
        <script>
            document.getElementById("searchUser").addEventListener("keyup", function () {
                let filter = this.value.toLowerCase();
                let users = document.querySelectorAll(".user-card");

                users.forEach(user => {
                    let name = user.querySelector(".user-name").textContent.toLowerCase();
                    let profile = user.querySelector(".user-profile").textContent.toLowerCase();

                    if (name.includes(filter) || profile.includes(filter)) {
                        user.style.display = "block";
                    } else {
                        user.style.display = "none";
                    }
                });
            });
        </script>

        <!--Fin  Panneau des destinataires -->
    </div>
</div>

<style>
#userSelection.show { display: block !important; }
.select-header { border-left: 3px solid var(--bs-primary); padding-left: 1rem; }

.recipient-preview {
    display: flex;
    align-items: center;
    padding: 0.75rem;
    background: var(--bs-light);
    border-radius: 0.5rem;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.btn-outline-success { border-color: var(--bs-success); color: var(--bs-success); }
.btn-outline-warning { border-color: var(--bs-warning); color: var (--bs-warning); }
.btn-outline-danger { border-color: var(--bs-danger); color: var(--bs-danger); }
.user-avatar { width: 40px; height: 40px; }

.card:hover {
    background-color: #f8f9fa;
    transition: background-color 0.3s ease-in-out;
}


</style>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const recipientType = document.getElementById('recipientType');
    const userSelect = document.getElementById('userSelect');
    const recipientPreview = document.getElementById('recipientPreview');

    const updatePreview = () => {
        let content = '';
        const type = recipientType.value;

        if (type === 'specific') {
            const selected = Array.from(document.querySelectorAll('input[name="recipients[]"]:checked'));
            content = selected.map(opt => `
                <div class="recipient-preview">
                    <i class="fas fa-user-circle me-2 text-primary"></i>
                    ${opt.nextElementSibling.textContent.trim()}
                </div>
            `).join('') || '<div class="text-center text-muted py-3">Aucune sélection</div>';
        } else {
            const labels = {
                all_participants: 'Tous les participants',
                treasurer: 'Tous les trésoriers',
                admin: 'Tous les administrateurs',
                all_users: 'Tous les utilisateurs'
            };
            content = `
                <div class="recipient-preview">
                    <i class="fas fa-users me-2 text-success"></i>
                    ${labels[type] || 'Destinataires généraux'}
                </div>
            `;
        }

        recipientPreview.innerHTML = content;
    };

    recipientType.addEventListener('change', function() {
        const selectionDiv = document.getElementById('userSelection');
        selectionDiv.classList.toggle('show', this.value === 'specific');
        updatePreview();
    });

    document.querySelectorAll('input[name="recipients[]"]').forEach(checkbox => {
        checkbox.addEventListener('change', updatePreview);
    });
});
</script>
@endsection
@endsection

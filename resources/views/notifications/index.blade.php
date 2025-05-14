@extends('layouts.app')

@section('title', 'Historique des Notifications')

@section('contenu')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0">
                <!-- En-tête amélioré -->
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-bell fa-lg"></i>
                        <h2 class="h4 mb-0 fw-semibold">Historique des Notifications</h2>
                    </div>
                    <form action="{{ route('notifications.mark-all-as-read') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-light btn-sm rounded-pill px-3 hover-lift">
                            <i class="fas fa-check-double me-2"></i>Tout marquer comme lu
                        </button>
                    </form>
                </div>

                <!-- Liste des notifications avec espacement -->
                <div class="card-body p-0">
                    @forelse($notifications as $notification)
                    <div class="notification-item {{ $notification->pivot->read ? 'bg-white' : 'bg-light' }}
                         border-bottom p-4 position-relative transition-all mb-3">
                        <a href="{{ route('notifications.show', $notification->id) }}"
                           class="text-decoration-none text-dark d-block"
                           onclick="markAsRead(event, '{{ $notification->id }}')">
                            <div class="d-flex gap-3 align-items-start">
                                <!-- Icône mise en valeur -->
                                <div class="icon-indicator bg-{{ $notification->data['type'] ?? 'primary' }}
                                         text-white rounded-circle p-2 shadow-sm flex-shrink-0">
                                    <i class="fas fa-{{ $notification->data['icon'] ?? 'bell' }} fa-fw"></i>
                                </div>

                                <!-- Contenu avec espacement amélioré -->
                                <div class="flex-grow-1 pe-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2 gap-2">
                                        <h5 class="mb-0 fw-semibold text-dark">
                                            {{ $notification->title ?? 'Nouvelle notification' }}
                                        </h5>
                                        <small class="text-muted text-nowrap">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $notification->created_at->isoFormat('DD MMM YYYY - HH:mm') }}
                                        </small>
                                    </div>
                                    <p class="mb-0 text-muted lh-base">
                                        {{ $notification->message }}
                                    </p>
                                </div>
                            </div>
                        </a>

                        <!-- Indicateur non-lu amélioré -->
                        @if(!$notification->pivot->read)
                        <span class="position-absolute start-0 top-50 translate-middle-y
                                  bg-danger rounded-pill pulse" style="width: 5px; height: 70%">
                        </span>
                        @endif
                    </div>
                    @empty
                    <!-- État vide stylisé -->
                    <div class="text-center p-5 bg-light-subtle">
                        <div class="mb-4 opacity-25">
                            <i class="fas fa-bell-slash fa-3x"></i>
                        </div>
                        <h4 class="h5 text-muted mb-2">Aucune notification disponible</h4>
                        <p class="text-muted small">Vous serez alerté ici des nouvelles activités</p>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination stylisée -->
                @if($notifications->hasPages())
                <div class="card-footer bg-white border-top-0 py-3">
                    <div class="d-flex justify-content-center">
                        {{ $notifications->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function markAsRead(event, notificationId) {
    event.preventDefault();

    fetch(`/notifications/${notificationId}/mark-as-read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            const badge = document.querySelector('.notification-badge');
            if(badge) badge.textContent = data.unread_count;

            const item = event.target.closest('.notification-item');
            item.classList.remove('bg-light');
            item.querySelector('.pulse')?.remove();

            // Redirection après animation
            setTimeout(() => {
                window.location = event.target.closest('a').href;
            }, 300);
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>

<style>
.notification-item {
    transition: all 0.25s ease;
    margin: 0.5rem;
    border-radius: 0.5rem;
}

.notification-item:hover {
    box-shadow: 0 0.25rem 0.75rem rgba(0,0,0,0.05);
    transform: translateY(-2px);
}

.icon-indicator {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pulse {
    animation: pulse 1.5s infinite;
    box-shadow: 0 0 0 0 rgba(220,53,69,0.4);
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(220,53,69,0.4); }
    70% { box-shadow: 0 0 0 8px rgba(220,53,69,0); }
    100% { box-shadow: 0 0 0 0 rgba(220,53,69,0); }
}

.hover-lift:hover {
    transform: translateY(-1px);
    box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
}

.card-header {
    background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
}
</style>
@endsection

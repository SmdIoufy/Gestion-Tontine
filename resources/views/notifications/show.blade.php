@extends('layouts.app')

@section('title', 'Détails de la Notification')

@section('contenu')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h1 class="h4 mb-0">
                        <i class="fas fa-info-circle me-2"></i>Détails de la Notification
                    </h1>
                </div>

                <div class="card-body">
                    <!-- En-tête -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <span class="badge bg-@if($notification->priority == 'low')success
                                                 @elseif($notification->priority == 'medium')warning
                                                 @else danger @endif">
                                Priorité {{ ucfirst($notification->priority) }}
                            </span>
                        </div>
                        <small class="text-muted">
                            Envoyée le {{ $notification->created_at->isoFormat('LL à HH:mm') }}
                        </small>
                    </div>

                    <!-- Corps -->
                    <div class="mb-4">
                        <h3 class="h5 fw-bold">{{ $notification->title }}</h3>
                        <p class="mb-0 text-muted">{{ $notification->message }}</p>
                    </div>

                    <!-- Métadonnées -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-medium">Expéditeur</label>
                                <p class="mb-0">{{ $notification->sender->name }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-medium">Destinataires</label>
                                <ul class="list-unstyled mb-0">
                                    @foreach($notification->recipients as $recipient)
                                    <li>{{ $recipient->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-4">
                        <a href="{{ route('notifications.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-list me-2"></i>Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.badge {
    font-size: 0.9rem;
    padding: 0.5em 0.75em;
}
</style>
@endsection

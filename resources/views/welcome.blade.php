@extends('layouts.app')

@section('contenu')
<div class="min-vh-100 bg-custom-gradient d-flex align-items-center justify-content-center p-4">
    <div class="auth-card">
        <div class="header text-center mb-4">
            <div class="header-icon mx-auto mb-3">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <h1 class="display-6 fw-bold text-dark mb-2">Bienvenue sur UADB Tontine</h1>
            <p class="text-muted">Gestion simplifiée de vos tontines collaboratives</p>
        </div>

        <div class="d-flex flex-column gap-3 mt-4">
            <a href="{{ route('inscription.index') }}" class="btn btn-primary-custom">
                <i class="fas fa-user-plus me-2"></i>
                Créer un compte
            </a>

            <a href="{{ route('auth.create') }}" class="btn btn-secondary-custom">
                <i class="fas fa-sign-in-alt me-2"></i>
                Se connecter
            </a>
        </div>

        <div class="footer-links mt-4 pt-3">
            <p class="text-muted small mb-0">
                En continuant, vous acceptez nos
                <a href="{{ route('cgu') }}" class="text-primary-link" style="color: var(--primary-600);">Conditions d'utilisation</a>
            </p>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-50: #f0f4ff;
        --primary-100: #d6e4ff;
        --primary-500: #3b82f6;
        --primary-600: #2563eb;
    }

    .bg-custom-gradient {
        background: linear-gradient(to bottom right, var(--primary-50), var(--primary-100));
    }

    .auth-card {
        background: white;
        border-radius: 1.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        padding: 2.5rem;
        width: 100%;
        max-width: 32rem;
        position: relative;
        overflow: hidden;
    }

    .auth-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #8aaadd 20%, var(--primary-600) 80%);
    }

    .header-icon {
        background: var(--primary-50);
        width: 64px;
        height: 64px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .header-icon i {
        font-size: 2rem;
        color: var(--primary-600);
    }

    .btn-primary-custom {
        background: linear-gradient(90deg, var(--primary-500) 0%, var(--primary-600) 100%);
        color: white !important;
        padding: 1rem;
        border-radius: 0.75rem;
        font-weight: 500;
        border: none;
        transition: all 0.2s ease;
        text-align: center;
        text-decoration: none;
        display: block;
        width: 100%;
    }

    .btn-primary-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
    }

    .btn-secondary-custom {
        border: 2px solid var(--primary-500);
        color: var(--primary-500) !important;
        padding: 1rem;
        border-radius: 0.75rem;
        font-weight: 500;
        background: transparent;
        transition: all 0.2s ease;
        text-align: center;
        text-decoration: none;
        display: block;
        width: 100%;
    }

    .btn-secondary-custom:hover {
        background: var(--primary-50);
        transform: translateY(-1px);
    }

    .footer-links {
        border-top: 1px solid #dee2e6;
    }

    .text-primary-link {
        color: var(--primary-600);
        text-decoration: none;
    }

    .text-primary-link:hover {
        text-decoration: underline;
    }
</style>
@endsection

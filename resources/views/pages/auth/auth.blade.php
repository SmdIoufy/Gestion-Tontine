@extends('layouts.app')

@section('contenu')
<div class="auth-container d-flex justify-content-center align-items-center min-vh-100 p-3">
    <div class="auth-card">
        <div class="header text-center mb-4">
            <div class="header-icon mx-auto mb-3">
                <i class="fas fa-lock"></i>
            </div>
            <h1 class="h2 fw-bold mb-2">Bienvenue sur Gestion Tontine</h1>
            <p class="text-muted">Connectez-vous à votre compte</p>
        </div>

        <form method="POST" action="{{ route('auth.store') }}">
            @csrf

            <div class="mb-4">
                <div class="input-wrapper position-relative">
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Adresse email"
                        required
                    >
                    <i class="fas fa-envelope input-icon"></i>
                </div>
            </div>

            <div class="mb-4">
                <div class="input-wrapper position-relative">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="Mot de passe"
                        required
                    >
                    <i class="fas fa-eye-slash input-icon password-toggle" onclick="togglePassword()"></i>
                </div>
            </div>

            <button type="submit" class="btn btn-primary-custom w-100">
                <i class="fas fa-sign-in-alt me-2"></i>Se connecter
            </button>
        </form>

        <div class="footer-links mt-4 pt-3 text-center">
            <div>
                <a href="{{ route('password.request') }}" class="text-decoration-none">Mot de passe oublié ?</a> •
                <a href="{{ route('inscription.index') }}" class="text-decoration-none">Créer un compte</a>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const password = document.getElementById('password');
        const icon = document.querySelector('.password-toggle');

        if(password.type === 'password') {
            password.type = 'text';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        } else {
            password.type = 'password';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        }
    }
</script>

<style>
    :root {
        --primary-50: #f0f4ff;
        --primary-100: #d6e4ff;
        --primary-500: #3b82f6;
        --primary-600: #2563eb;
        --gray-700: #374151;
    }

    .auth-container {
        background: linear-gradient(135deg, var(--primary-50) 0%, var(--primary-100) 100%);
    }

    .auth-card {
        background: white;
        border-radius: 1.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 480px;
        padding: 2.5rem;
        position: relative;
        overflow: hidden;
    }

    .auth-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 8px;
        background: linear-gradient(90deg, var(--primary-500) 0%, var(--primary-600) 100%);
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

    .input-wrapper input {
        border: 2px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 0.875rem 1rem;
        transition: all 0.2s ease;
    }

    .input-wrapper input:focus {
        border-color: var(--primary-500);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .input-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        cursor: pointer;
    }

    .btn-primary-custom {
        background: linear-gradient(90deg, var(--primary-500) 0%, var(--primary-600) 100%);
        color: white;
        border: none;
        border-radius: 0.75rem;
        padding: 1rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-primary-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
    }

    .footer-links a {
        color: var(--gray-700);
        transition: color 0.2s ease;
    }

    .footer-links a:hover {
        color: var(--primary-600);
    }

    @media (max-width: 480px) {
        .auth-card {
            padding: 2rem 1.5rem;
            border-radius: 1rem;
        }
    }
</style>
@endsection

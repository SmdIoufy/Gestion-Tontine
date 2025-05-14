<?php
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Gestion Tontine') }}</title>

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2-custom.css') }}">

    <style>
        :root {
            --primary-500: #3b82f6;
            --primary-600: #2563eb;
            --gray-100: #f3f4f6;
            --bs-primary-bg-subtle: #e8f2ff;
            --primary-soft: #e3f2fd;
            --info-soft: #e5f6fd;
        }

        .navbar {
            background: linear-gradient(to right, var(--primary-500), var(--primary-600)) !important;
        }

        .nav-search {
            max-width: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2rem;
            transition: all 0.3s ease;
        }

        .nav-search:focus-within {
            background: rgba(255, 255, 255, 0.2);
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            font-size: 0.75rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            transition: transform 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.1);
        }

        .footer {
            background: linear-gradient(to bottom right, var(--primary-500), var(--primary-600));
            color: rgba(255, 255, 255, 0.8);
            padding: 4rem 0 2rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: white;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.55);
            transition: all 0.5s ease;
        }

        .social-icon:hover {
            background: rgba(255, 255, 255, 0.83);
            transform: translateY(6px);
            transform: translateX(3px);
        }
    </style>
    @stack('styles')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100">
    <nav class="navbar navbar-expand-lg fixed-top shadow-lg">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center text-white text-decoration-none" href="{{ route('home') }}">
                <div class="bg-white p-2 rounded me-2">
                    <i class="fas fa-hand-holding-usd text-primary"></i>
                </div>
                <span class="fs-4 fw-bold">UADB-<span class="fw-light">Tontine</span></span>
            </a>

            <!-- Elements de droite -->
            <div class="d-flex align-items-center gap-3 ms-auto"> <!-- Modification ici -->
                @auth
                <!-- Barre de recherche -->
                <div class="position-relative nav-search mx-3">
                    <input type="text" class="form-control border-0 bg-transparent text-white" placeholder="Rechercher...">
                    <button class="btn btn-link text-white position-absolute end-0 top-50 translate-middle-y">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

                <!-- Notifications-->
                <div class="dropdown notification-menu position-relative">
                    <a href="#" class="position-relative nav-link px-3"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                        <i class="fas fa-bell fs-5 bell-animation text-white-80"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger badge-pulse">
                            {{ auth()->user()->customNotifications()->wherePivot('read', false)->count() }}
                            <span class="visually-hidden">Notifications non lues</span>
                        </span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end notification-dropdown p-2 border-0">
                        <li>
                            <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom bg-light">
                                <h6 class="mb-0 fw-semibold text-primary">
                                    <i class="fas fa-bell me-2"></i>Notifications
                                </h6>
                                <small class="text-muted fw-medium">
                                    {{ auth()->user()->customNotifications()->count() }} au total
                                </small>
                            </div>
                        </li>

                        <div class="notification-list" style="max-height: 60vh; overflow-y: auto;">
                            @forelse(auth()->user()->customNotifications()->take(8)->get() as $notification)
                            <li>
                                <a href="{{ $notification->data['link'] ?? '#' }}"
                                class="dropdown-item rounded-3 p-3 d-flex gap-3 align-items-start
                                        {{ $notification->pivot->read ? 'opacity-75' : 'notification-unread' }}"
                                onclick="markAsRead('{{ $notification->id }}')">
                                    <div class="icon-wrapper bg-{{ $notification->data['type'] ?? 'primary' }}
                                                text-white rounded-3 p-2">
                                        <i class="fas fa-{{ $notification->data['icon'] ?? 'bell' }} fs-5"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="fw-medium text-dark">{{ $notification->data['title'] ?? 'Nouvelle notification' }}</span>
                                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="mb-0 small text-muted lh-sm">
                                            {{ Str::limit($notification->data['message'] ?? '', 80) }}
                                        </p>
                                    </div>
                                </a>
                            </li>
                            @empty
                            <li class="text-center py-4">
                                <div class="mb-3">
                                    <i class="fas fa-bell-slash fs-1 text-primary opacity-25"></i>
                                </div>
                                <p class="mb-0 text-muted fw-medium">Aucune notification disponible</p>
                                <small class="text-muted">Nous vous informerons des nouvelles activités</small>
                            </li>
                            @endforelse
                        </div>

                        <li class="mt-2 bg-light">
                            <a href="{{ route('notifications.index') }}"
                            class="btn btn-primary w-100 py-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-list-ul me-2"></i>Voir l'historique complet
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Messages-->
                <a href="#" class="text-white text-decoration-none ms-3">
                    <i class="fas fa-comment-dots"></i>
                </a>
                @endauth

                <!-- Menu utilisateur -->
                @guest
                    <a href="{{ route('auth.create') }}" class="btn btn-outline-light me-2">
                        <i class="fas fa-sign-in-alt me-2"></i>Connexion
                    </a>
                    <a href="{{ route('inscription.index') }}" class="btn btn-light text-primary">
                        <i class="fas fa-user-plus me-2"></i>Inscription
                    </a>
                @else
                    <div class="dropdown ms-3"> <!-- Modification ici -->
                        <button class="btn btn-transparent dropdown-toggle d-flex align-items-center gap-2"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                            <img src="https://source.unsplash.com/random/100x100/?person"
                                 class="user-avatar rounded-circle">
                            <span class="text-white">{{ Auth::user()->name }}</span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">
                                <i class="fas fa-user-cog me-2"></i>Profil
                            </a></li>
                            <li><a class="dropdown-item" href="#">
                                <i class="fas fa-cog me-2"></i>Paramètres
                            </a></li>
                            <li><a class="dropdown-item" href="#">
                                <i class="fas fa-chart-line me-2"></i>Dashboard
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="container py-4" style="padding-top: 80px;">
        <div class="bg-white rounded-3 shadow-sm p-4 p-lg-5">
            @yield('contenu')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto">
        <div class="container">
            <div class="row g-5">
                <!-- Colonne 1 - Présentation -->
                <div class="col-lg-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-white p-2 rounded me-3">
                            <i class="fas fa-hand-holding-usd text-primary"></i>
                        </div>
                        <h4 class="text-white mb-0">UADB-Tontine</h4>
                    </div>
                    <p class="mb-4">
                        Réinventons ensemble la gestion des tontines traditionnelles
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <!-- Colonne 2 - Navigation -->
                <div class="col-lg-2 col-6">
                    <h5 class="text-white mb-4">Navigation</h5>
                    <ul class="list-unstyled footer-links">
                        <li class="mb-2"><a href="{{ route('home') }}"><i class="fas fa-home me-2"></i>Accueil</a></li>
                        <li class="mb-2"><a href="{{ route('apropos') }}"><i class="fas fa-info-circle me-2"></i>À propos</a></li>
                    </ul>
                </div>

                <!-- Colonne 3 - Légal -->
                <div class="col-lg-2 col-6">
                    <h5 class="text-white mb-4">Légal</h5>
                    <ul class="list-unstyled footer-links">
                        <li class="mb-2"><a href="{{ route('cgu') }}"><i class="fas fa-balance-scale me-2"></i>CGU</a></li>
                        <li class="mb-2"><a href="{{ route('confidentialite') }}"><i class="fas fa-lock me-2"></i>Confidentialité</a></li>
                        <li class="mb-2"><a href="{{route ('contrat')}}"><i class="fas fa-file-contract me-2"></i>Contrat</a></li>
                    </ul>
                </div>

                <!-- Colonne 4 - Contact -->
                <div class="col-lg-4">
                    <h5 class="text-white mb-4">Commentaire</h5>
                    <form class="contact-form">
                        <div class="mb-3">
                            <textarea class="form-control bg-transparent text-white border-white" placeholder="Votre message..." style="height: 100px;"></textarea>
                        </div>
                        <button class="btn btn-outline-light w-100">
                            <i class="fas fa-paper-plane me-2"></i>Envoyer
                        </button>
                    </form>
                </div>
            </div>

            <hr class="my-5 opacity-25">

            <div class="text-center text-white-50">
                <p class="mb-0">
                    © {{ date('Y') }} UADB-Tontine - Tous droits réservés
                    <br>
                    <small>Conçu par le GROUPE-7</small>
                </p>
                <a href="#" class="btn btn-link text-white mt-3">
                    <i class="fas fa-arrow-up"></i> Retour en haut
                </a>
            </div>
        </div>
    </footer>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
</body>
</html>

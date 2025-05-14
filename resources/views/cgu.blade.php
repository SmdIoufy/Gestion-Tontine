@extends('layouts.app')

@section('contenu')
<div class="cgu-page">
    <!-- En-tête académique -->
    <section class="hero-section py-5 text-center text-white bg-primary">
        <div class="container">
            <h1 class="display-5 fw-bold mb-3">Conditions d'Utilisation Académique</h1>
            <div class="badge bg-light text-primary fs-6">Projet étudiant - Groupe 7</div>
        </div>
    </section>

    <!-- Introduction -->
    <section class="introduction-section py-5">
        <div class="container">
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                Ce document est une simulation pédagogique sans valeur légale réelle
            </div>
            <p class="lead">
                Ces conditions décrivent les règles d'utilisation de notre projet étudiant <strong>UADB-Tontine</strong>,
                développé dans le cadre de notre formation universitaire.
            </p>
        </div>
    </section>

    <!-- Définitions -->
    <section class="definitions-section py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold text-center mb-4"><i class="fas fa-book me-2"></i>Définitions</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h4 class="text-primary"><i class="fas fa-user me-2"></i>Utilisateur</h4>
                            <p>Étudiant ou enseignant participant au projet pédagogique</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h4 class="text-primary"><i class="fas fa-cogs me-2"></i>Service</h4>
                            <p>Plateforme de démonstration pour l'apprentissage des systèmes de gestion</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Conditions académiques -->
    <section class="conditions-section py-5">
        <div class="container">
            <h2 class="fw-bold text-center mb-4"><i class="fas fa-graduation-cap me-2"></i>Règles d'Utilisation</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 border-start border-3 border-primary">
                        <div class="card-body">
                            <h4>Accès</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Réservé à la communauté universitaire
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Usage pédagogique uniquement
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-start border-3 border-primary">
                        <div class="card-body">
                            <h4>Engagements</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-ban text-danger me-2"></i>
                                    Pas d'utilisation commerciale
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-ban text-danger me-2"></i>
                                    Données fictives uniquement
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Responsabilités -->
    <section class="responsabilites-section py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold text-center mb-4"><i class="fas fa-exclamation-triangle me-2"></i>Limitations</h2>
            <div class="alert alert-warning">
                <h5>Attention : Projet en développement</h5>
                <ul>
                    <li>Fonctionnalités non finalisées</li>
                    <li>Possibles instabilités techniques</li>
                    <li>Absence de support technique</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Données -->
    <section class="privacy-section py-5">
        <div class="container">
            <h2 class="fw-bold text-center mb-4"><i class="fas fa-database me-2"></i>Gestion des Données</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5>Collecte</h5>
                            <p class="small">
                                Seules les données nécessaires à la démonstration pédagogique sont collectées
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5>Conservation</h5>
                            <p class="small">
                                Toutes les données seront supprimées à la fin de l'année académique
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact académique -->
    <section class="contact-section py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="fw-bold mb-4"><i class="fas fa-envelope me-2"></i>Contact</h2>
            <div class="d-flex flex-column align-items-center">
                <div class="mb-2">
                    <i class="fas fa-user-graduate me-2"></i>
                    Groupe 7 - Projet Tontine
                </div>
                <div class="mb-2">
                    <i class="fas fa-university me-2"></i>
                    Université Alioune Diop de Bambey
                </div>
                <div>
                    <i class="fas fa-calendar me-2"></i>
                    Année académique 2023/2024
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .cgu-page .card {
        border-radius: 0.75rem;
        transition: transform 0.3s ease;
    }

    .cgu-page .card:hover {
        transform: translateY(-5px);
    }

    .hero-section {
        background: linear-gradient(45deg, #2563eb, #1e40af);
    }

    .responsabilites-section .alert {
        border-left: 4px solid #ffc107;
    }

    .cgu-page h2 {
        margin-bottom: 1.5rem;
    }

    .cgu-page p.lead {
        font-size: 1.25rem;
    }

    .cgu-page .card-body h4, .cgu-page .card-body h5 {
        margin-bottom: 1rem;
    }

    .cgu-page .card-body ul {
        padding-left: 1.5rem;
    }

    .cgu-page .card-body ul li {
        margin-bottom: 0.75rem;
    }

    .cgu-page .contact-section .d-flex div {
        margin-bottom: 0.5rem;
    }
</style>
@endsection
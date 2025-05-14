@extends('layouts.app')

@section('contenu')
<div class="privacy-policy container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="h3 mb-0">Politique de Confidentialité - UADB-Tontine</h1>
            <p class="mb-0 small">Projet académique du Groupe 7 - Dernière mise à jour : 15 Mars 2025</p>
        </div>

        <div class="card-body">
            <section class="mb-5">
                <h2 class="h4 text-primary mb-3">1. Introduction</h2>
                <p>
                    Ce projet de gestion de tontines ("UADB-Tontine") est développé dans le cadre académique
                    par le Groupe 7. Cette politique explique comment nous traitons les données dans le
                    contexte strict de ce projet éducatif.
                </p>
            </section>

            <section class="mb-5">
                <h2 class="h4 text-primary mb-3">2. Données Collectées</h2>
                <p>Dans le cadre pédagogique, nous pouvons collecter :</p>
                <ul>
                    <li>Informations de compte (nom, email)</li>
                    <li>Données de transactions simulées</li>
                    <li>Historique des interactions avec la plateforme</li>
                    <li>Données techniques (adresse IP, type de navigateur)</li>
                </ul>
            </section>

            <section class="mb-5">
                <h2 class="h4 text-primary mb-3">3. Utilisation des Données</h2>
                <p>Les données servent exclusivement à :</p>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="bg-light p-3 rounded">
                            <i class="fas fa-graduation-cap text-primary me-2"></i>
                            Démonstration pédagogique
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light p-3 rounded">
                            <i class="fas fa-lock text-primary me-2"></i>
                            Gestion de l'authentification
                        </div>
                    </div>
                </div>
            </section>

            <section class="mb-5">
                <h2 class="h4 text-primary mb-3">4. Sécurité des Données</h2>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Mesures mises en œuvre dans le cadre du projet :
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <i class="fas fa-shield-alt text-success me-2"></i>
                        Chiffrement des mots de passe
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-database text-success me-2"></i>
                        Accès restreint aux données
                    </li>
                </ul>
            </section>

            <section class="mb-5">
                <h2 class="h4 text-primary mb-3">5. Conservation des Données</h2>
                <p>
                    Les données seront conservées uniquement pendant la durée du projet académique
                    (du [date début] au [date fin]). Toutes les données seront supprimées à la fin
                    de la période d'évaluation.
                </p>
            </section>

            <section class="mb-5">
                <h2 class="h4 text-primary mb-3">6. Vos Droits</h2>
                <p>Dans le contexte académique :</p>
                <div class="row g-3">
                    <div class="col-md-4 text-center">
                        <div class="p-3 border rounded">
                            <i class="fas fa-eye fa-2x text-primary mb-2"></i>
                            <div>Droit d'accès</div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="p-3 border rounded">
                            <i class="fas fa-eraser fa-2x text-primary mb-2"></i>
                            <div>Droit de rectification</div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="p-3 border rounded">
                            <i class="fas fa-trash fa-2x text-primary mb-2"></i>
                            <div>Droit de suppression</div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mb-4">
                <h2 class="h4 text-primary mb-3">8. Contact</h2>
                <p>
                    Pour toute question relative au présent contrat, veuillez contacter :<br>
                    <i class="fas fa-users me-2"></i>Groupe-7<br>
                    <i class="fas fa-map-marker-alt me-2"></i>Université Alioune Diop, Bambey
                </p>
            </section>

            <div class="alert alert-warning mt-4">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Ce document est une simulation pédagogique et n'a pas de valeur légale réelle.
            </div>
        </div>
    </div>
</div>

<style>
    .privacy-policy {
        max-width: 800px;
        margin: 0 auto;
    }

    .privacy-policy h2 {
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 0.5rem;
    }

    .list-group-item {
        border: none;
        padding-left: 0;
    }
</style>
@endsection

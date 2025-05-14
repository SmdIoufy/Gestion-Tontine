@extends('layouts.app')

@section('contenu')
<div class="about-page ">
    <!-- Section Héro -->
    <section class="hero-section py-5">
        <div class="container text-center">
            <h1 class="display-5 fw-bold mb-4">Projet Étudiant - Gestion de Tontines</h1>
            <p class="lead">Projet académique développé dans le cadre de notre formation en L3 Développement et Administration d'Application</p>
            <div class="mt-4">
                <img src="https://source.unsplash.com/random/800x400?university,teamwork"
                     alt="Équipe étudiante"
                     class="img-fluid rounded-3 shadow-sm">
            </div>
        </div>
    </section>

    <!-- Présentation du Projet -->
    <section class="presentation-section py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold text-center mb-5">Présentation du Projet</h2>
            <div class="row">
                <div class="col-md-6">
                    <p class="lead">
                        Ce projet a pour but de développer une application de gestion de tontines, permettant aux utilisateurs de créer, rejoindre et suivre leurs tontines dans un environnement sécurisé.
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="lead">
                        Il s'agit d'une application modulaire, pensée pour être évolutive et facile à maintenir. Elle intègre une interface moderne développée avec Laravel et Bootstrap, garantissant une expérience utilisateur fluide et réactive.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Objectifs Pédagogiques -->
    <section class="objectives-section py-5">
        <div class="container">
            <h2 class="fw-bold text-center mb-5">🎯 Objectifs Pédagogiques</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-book-open fa-2x text-primary mb-3"></i>
                            <h4>Apprentissage Pratique</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Maîtrise du framework Laravel
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Gestion de projet collaboratif
                                </li>
                                <li>
                                    <i class="fas fa-check text-success me-2"></i>
                                    Conception d'interfaces modernes et responsives
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-lightbulb fa-2x text-primary mb-3"></i>
                            <h4>Défis Techniques</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-cog text-info me-2"></i>
                                    Sécurisation des transactions et gestion des paiements
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-cog text-info me-2"></i>
                                    Mise en place d'un système d'authentification robuste
                                </li>
                                <li>
                                    <i class="fas fa-cog text-info me-2"></i>
                                    Architecture modulaire et évolutive
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fonctionnalités de l'Application -->
    <section class="features-section py-5 bg-white">
        <div class="container">
            <h2 class="fw-bold text-center mb-5">🚀 Fonctionnalités Clés</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-users fa-2x text-primary mb-3"></i>
                            <h4>Gestion des Utilisateurs</h4>
                            <p>Inscription, connexion et personnalisation du profil pour une expérience adaptée.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-hand-holding-usd fa-2x text-primary mb-3"></i>
                            <h4>Gestion des Tontines</h4>
                            <p>Création, participation et suivi des tontines avec notifications et rappels automatiques.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-chart-line fa-2x text-primary mb-3"></i>
                            <h4>Suivi des Transactions</h4>
                            <p>Historique détaillé des paiements, analyses et rapports pour une gestion transparente.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Équipe Étudiante -->
    <section class="team-section py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold text-center mb-5">👩💻 Équipe de Développement</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4 text-center">
                    <div class="team-member">
                        <img src="https://source.unsplash.com/random/200x200?student"
                             alt="Membre d'équipe"
                             class="rounded-circle mb-3">
                        <h5>Étudiant Développeur</h5>
                        <p class="text-muted small">Spécialité Backend</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="team-member">
                        <img src="https://source.unsplash.com/random/200x200?programmer"
                             alt="Membre d'équipe"
                             class="rounded-circle mb-3">
                        <h5>Étudiant Intégrateur</h5>
                        <p class="text-muted small">Frontend & Design</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="team-member">
                        <img src="https://source.unsplash.com/random/200x200?coding"
                             alt="Membre d'équipe"
                             class="rounded-circle mb-3">
                        <h5>Étudiant Administrateur</h5>
                        <p class="text-muted small">Gestion de l'Infrastructure</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technologies Utilisées -->
    <section class="tech-section py-5">
        <div class="container">
            <h2 class="fw-bold text-center mb-5">🛠️ Stack Technologique</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-auto text-center">
                    <div class="tech-item p-3 rounded">
                        <i class="fab fa-laravel fa-3x text-danger"></i>
                        <div class="mt-2">Laravel</div>
                    </div>
                </div>
                <div class="col-auto text-center">
                    <div class="tech-item p-3 rounded">
                        <i class="fab fa-bootstrap fa-3x text-primary"></i>
                        <div class="mt-2">Bootstrap</div>
                    </div>
                </div>
                <div class="col-auto text-center">
                    <div class="tech-item p-3 rounded">
                        <i class="fas fa-database fa-3x text-warning"></i>
                        <div class="mt-2">MySQL</div>
                    </div>
                </div>
                <!-- Vous pouvez ajouter d'autres technologies -->
            </div>
        </div>
    </section>

    <!-- Démarche Pédagogique -->
    <section class="process-section py-5 bg-primary text-white">
        <div class="container">
            <h2 class="fw-bold text-center mb-5">📚 Démarche Académique</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="process-step text-center">
                        <div class="step-number mb-3">1</div>
                        <h5>Analyse des Besoins</h5>
                        <p class="small">Étude des systèmes de tontines traditionnelles et recueil des attentes utilisateurs.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="process-step text-center">
                        <div class="step-number mb-3">2</div>
                        <h5>Conception & Modélisation</h5>
                        <p class="small">Création de wireframes, maquettes et modélisation UML pour une architecture claire.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="process-step text-center">
                        <div class="step-number mb-3">3</div>
                        <h5>Implémentation & Tests</h5>
                        <p class="small">Développement itératif avec intégration continue et tests fonctionnels réguliers.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Défis Rencontrés -->
    <section class="challenges-section py-5">
        <div class="container">
            <h2 class="fw-bold text-center mb-5">⚡ Défis Rencontrés</h2>
            <div class="accordion" id="challengesAccordion">
                <div class="accordion-item">
                    <h3 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#challenge1">
                            Gestion des Transactions
                        </button>
                    </h3>
                    <div id="challenge1" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <p>Conception d'un système sécurisé pour le suivi des paiements, incluant l'authentification, la validation et le chiffrement des données sensibles.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h3 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#challenge2">
                            Sécurité et Authentification
                        </button>
                    </h3>
                    <div id="challenge2" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <p>Mise en place d'un système d'authentification robuste, gestion des sessions et protection contre les attaques CSRF et XSS.</p>
                        </div>
                    </div>
                </div>
                <!-- Ajouter d'autres défis si nécessaire -->
            </div>
        </div>
    </section>

    <!-- Bilan et Perspectives -->
    <section class="outlook-section py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold text-center mb-5">🔮 Bilan et Perspectives</h2>
            <div class="row">
                <div class="col-md-6">
                    <p class="lead">
                        Ce projet nous a permis d'appliquer concrètement nos acquis théoriques et de relever des défis techniques majeurs. Il représente une base solide pour des projets futurs dans le domaine des applications web.
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="lead">
                        Les perspectives d'évolution incluent l'ajout de notifications en temps réel, une interface utilisateur encore plus intuitive et l'intégration avec des API tierces pour enrichir l'expérience utilisateur.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Remerciements -->
    <section class="thanks-section py-5">
        <div class="container">
            <h2 class="fw-bold text-center mb-5">🙏 Remerciements</h2>
            <p class="lead text-center">
                Nous remercions chaleureusement le <strong>Dr Gaye</strong> , nos mentors à savoir <strong>Mr Gueye et Mr Ndiaye</strong> pour leur soutien et leurs précieux conseils tout au long de ce projet.
            </p>
        </div>
    </section>
</div>


<style>


    .hero-section {
        background: linear-gradient(45deg, #2563eb, #8b5cf6);
        color: #fff;
        margin-top: 60px;
    }
    .gradient-text {
        background: -webkit-linear-gradient(45deg, #2563eb, #8b5cf6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .team-member img {
        width: 150px;
        height: 150px;
        object-fit: cover;
    }

    .tech-item {
        padding: 1.5rem;
        border-radius: 1rem;
        background: rgba(0,0,0,0.05);
    }
    .process-step .step-number {
        width: 50px;
        height: 50px;
        background: #fff;
        color: #2563eb;
        border-radius: 50%;
        line-height: 50px;
        margin: 0 auto;
        font-weight: bold;
    }
    .challenges-section .accordion-button {
        font-weight: 600;
        background: rgba(0,0,0,0.03);
    }
</style>
@endsection

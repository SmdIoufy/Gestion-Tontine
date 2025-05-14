@extends('layouts.app')

@section('contenu')
<div class="contract container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="h3 mb-0">Contrat de Service - UADB-Tontine</h1>
            <p class="mb-0 small">Projet académique du Groupe 7 - Dernière mise à jour : 15 Mars 2025</p>
        </div>

        <div class="card-body">
            <section class="mb-5">
                <h2 class="h4 text-primary mb-3">1. Objet du Contrat</h2>
                <p>
                    Le présent contrat définit les termes et conditions régissant l'utilisation de la plateforme <strong>UADB-Tontine</strong>.
                    Il encadre la relation entre le prestataire (dans le cadre du projet académique du Groupe 7) et l'utilisateur.
                </p>
            </section>

            <section class="mb-5">
                <h2 class="h4 text-primary mb-3">2. Engagements du Prestataire</h2>
                <p>
                    Le prestataire s'engage à fournir une plateforme fonctionnelle, sécurisée et conforme aux spécifications du projet.
                    Il assure également la maintenance, la mise à jour et la protection des données conformément à la Politique de Confidentialité.
                </p>
            </section>

            <section class="mb-5">
                <h2 class="h4 text-primary mb-3">3. Obligations de l'Utilisateur</h2>
                <p>
                    L'utilisateur s'engage à utiliser la plateforme de manière responsable et à fournir des informations exactes lors de son inscription.
                    Toute utilisation frauduleuse ou abusive est strictement interdite.
                </p>
            </section>


            <section class="mb-5">
                <h2 class="h4 text-primary mb-3">4. Durée du Contrat</h2>
                <p>
                    Ce contrat est conclu pour la durée du projet académique.
                    Il pourra être renouvelé ou modifié en fonction des évolutions du projet.
                </p>
            </section>


            <section class="mb-5">
                <h2 class="h4 text-primary mb-3">5. Modalités de Résiliation</h2>
                <p>
                    Chacune des parties peut résilier le contrat moyennant un préavis, par notification écrite.
                    En cas de manquement grave, la résiliation pourra être effective immédiatement.
                </p>
            </section>


            <section class="mb-5">
                <h2 class="h4 text-primary mb-3">6. Confidentialité</h2>
                <p>
                    Les parties s'engagent à ne pas divulguer les informations confidentielles obtenues dans le cadre de l'exécution du présent contrat,
                    conformément aux dispositions de la Politique de Confidentialité de <strong>UADB-Tontine</strong>.
                </p>
            </section>

            <section class="mb-5">
                <h2 class="h4 text-primary mb-3">7. Litiges</h2>
                <p>
                    En cas de différend relatif à l'interprétation ou à l'exécution du présent contrat,
                    les parties s'efforceront de trouver une solution amiable. À défaut, le litige sera soumis aux juridictions compétentes.
                </p>
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
    .contract {
        max-width: 800px;
        margin: 0 auto;
    }
    .contract h2 {
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 0.5rem;
    }
    .list-group-item {
        border: none;
        padding-left: 0;
    }
</style>
@endsection

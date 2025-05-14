@extends('layouts.app')

@section('contenu')
<div class="container">
    <h1>Tableau de bord Gérant</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Statistiques</h3>
                </div>
                <div class="card-body">
                    <p>Nombre de membres: XXX</p>
                    <p>Nombre de tontines: XXX</p>
                    <p>Total des fonds: XXX</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Activités récentes</h3>
                </div>
                <div class="card-body">
                    <ul>
                        <li>Jean a rejoint la tontine "Avenir"</li>
                        <li>Marie a contribué 200€ à la tontine "Voyage"</li>
                        <li>Paul a retiré 500€ de la tontine "Épargne"</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Notifications</h3>
                </div>
                <div class="card-body">
                    <ul>
                        <li>Réunion de la tontine "Avenir" demain à 18h</li>
                        <li>Nouvelle contribution de 100€ requise pour la tontine "Voyage"</li>
                        <li>Rappel: Retrait possible à partir du 15 du mois</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

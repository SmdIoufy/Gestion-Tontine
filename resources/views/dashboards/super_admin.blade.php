@extends('layouts.app')

@section('contenu')
<div class="container">
    <h1>Tableau de bord Super Admin</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Utilisateurs</div>
                <div class="card-body">
                    <p>Gérer les utilisateurs de la plateforme.</p>
                    <a href="#" class="btn btn-primary">Voir les utilisateurs</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Statistiques</div>
                <div class="card-body">
                    <p>Voir les statistiques de la plateforme.</p>
                    <a href="#" class="btn btn-primary">Voir les statistiques</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Paramètres</div>
                <div class="card-body">
                    <p>Configurer les paramètres de la plateforme.</p>
                    <a href="#" class="btn btn-primary">Voir les paramètres</a>
                </div>
            </div>
        </div>
        <a href=" {{ route('notifications.create') }}" class="btn btn-primary">creer une notification</a>

    </div>
</div>
@endsection

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InscriptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TontineController;
use App\Http\Controllers\CotisationController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TirageController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\GerantController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\CaisseController;




Route::get('/', [InscriptionController::class, 'home'])->name('home');

//Inscription utilisateur
Route::get('register', [InscriptionController::class, 'index'])->name('inscription.index');
Route::post('validate-register', [InscriptionController::class, 'register'])
    ->name('inscription.register');

//Authentification
Route::get('connexion', [AuthController::class, 'create'])->name('auth.create');
Route::post('connexion', [AuthController::class, 'auth'])->name('auth.store');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Routes pour la réinitialisation du mot de passe
Route::get('password/reset', [PasswordResetController::class, 'request'])->name('password.request');
Route::post('password/email', [PasswordResetController::class, 'email'])->name('password.email');
Route::get('password/reset/{token}', [PasswordResetController::class, 'reset'])->name('password.reset');
Route::post('password/reset', [PasswordResetController::class, 'update'])->name('password.update');

// Ressources
Route::resource('notifications', NotificationController::class);
Route::resource('tontines', TontineController::class);
Route::resource('cotisations', CotisationController::class);
Route::resource('paiements', PaiementController::class);

// Tableau de bord des paiements
Route::get('/paiements', [PaiementController::class, 'index'])->name('paiements.index');
//Route::get('/paiements/create', [PaiementController::class, 'create'])->name('paiements.create');
Route::post('/paiements/initiate', [PaiementController::class, 'initiate'])->name('paiements.initiate');
Route::post('/paiements/notify', [PaiementController::class, 'handleNotify'])->name('paiements.notify');
Route::get('/paiements/success', [PaiementController::class, 'handleSuccess'])->name('paiements.success');
Route::get('/paiements/cancel', [PaiementController::class, 'handleCancel'])->name('paiements.cancel');
Route::post('tontines/{tontine}/join', [TontineController::class, 'join'])->name('tontines.join');
Route::post('/paiements', [PaiementController::class, 'store'])->name('paiements.store');

// Tableau de bord (protégé par le middleware auth)
Route::middleware(['auth'])->group(function () {
   //Dashboard en  fonction de l'utilisateur qui s'est connecté
    Route::get('/super-admin/dashboard', [SuperAdminController::class, 'index'])->name('super_admin.dashboard');

    Route::get('/gerant/dashboard', [GerantController::class, 'index'])->name('gerant.dashboard');
        Route::get('gerant', [GerantController::class, 'index'])->name('gerant.index');
        Route::get('gerant/creer', [GerantController::class, 'creer'])->name('gerant.creer');
        Route::post('gerant/enregistrer', [GerantController::class, 'enregistrer'])->name('gerant.enregistrer');
        Route::get('gerant/{tontine}/modifier', [GerantController::class, 'modifier'])->name('gerant.modifier');
        Route::put('gerant/{tontine}/mettreAJour', [GerantController::class, 'mettreAJour'])->name('gerant.mettreAJour');
        Route::delete('gerant/{tontine}', [GerantController::class, 'supprimer'])->name('gerant.supprimer');
        Route::put('/gerant/{id}/update', [GerantController::class, 'update'])->name('gerant.update');
        Route::get('/gerant/image/{id}/supprimer', [GerantController::class, 'supprimerImage'])->name('gerant.image.supprimer');
        Route::get('/caisse/details', [PaiementController::class, 'details'])->name('caisse.details');
        //Route::get('/tontines/{tontine}', [TontineController::class, 'show'])->name('tontines.show');
        //Route::post('/tontines/{tontine}/tirage', [TontineController::class, 'lancerTirage'])->name('tontines.tirage');
        Route::get('/gerant/tirages', [GerantController::class, 'afficherTirages'])->name('gerant.tirages');
        Route::post('/gerant/tirages/{idtontine}/lancer', [GerantController::class, 'lancerTirage'])->name('gerant.tirages.lancer');
        //Route::get('/caisse/details', [CaisseController::class, 'details'])->name('caisse.details');
        Route::get('/paiements/simulation', [PaiementController::class, 'afficherFormulaireSimulation'])->name('paiements.simulation');
        Route::post('/paiements/simuler', [PaiementController::class, 'simulerPaiement'])->name('paiements.simuler');
        Route::get('/paiements/historique', [PaiementController::class, 'afficherHistorique'])->name('paiements.historique');
        Route::get('/paiements/create', [PaiementController::class, 'afficherFormulaire'])->name('paiements.create');
        Route::post('/paiements/effectuer', [PaiementController::class, 'effectuerPaiement'])->name('paiements.effectuer');
        Route::get('/paiements/create/{idTontine}', [PaiementController::class, 'create'])->name('paiements.create');

    Route::get('/participant/dashboard', [ParticipantController::class, 'index'])->name('participant.dashboard');


        // Dashboard

            // Gestion des cotisations
            Route::get('/cotisations', [CotisationController::class, 'index'])->name('cotisations.index');
            Route::get('/cotisations/recu/{id}', [CotisationController::class, 'genererRecu'])->name('cotisations.recu');
            Route::get('/tours', [TourController::class, 'index'])->name('tours.index');
            Route::get('/tours/{id}/marquer', [TourController::class, 'marquer'])->name('tours.marquer');
            Route::get('/membres/{id}', [MembreController::class, 'show'])->name('membres.show');
            Route::get('/caisse/details', [CaisseController::class, 'details'])->name('caisse.details');
            Route::get('/rapports/export', [RapportController::class, 'export'])->name('rapports.export');
            Route::post('/notifications/send', [NotificationController::class, 'send'])->name('notifications.send');

        //fin pour le Gerant
    // Ressources
    Route::resource('notifications', NotificationController::class);
    Route::resource('tontines', TontineController::class);
    Route::resource('cotisations', CotisationController::class);
    Route::resource('paiements', PaiementController::class);
    Route::get('/cotisations', [CotisationController::class, 'index'])->name('cotisations.index');
    Route::post('/cotisations/valider', [CotisationController::class, 'valider'])->name('cotisations.valider');
    Route::get('/cotisations/recu/{id}', [CotisationController::class, 'genererRecu'])->name('cotisations.recu');

    // Tontines
    Route::post('tontines/{tontine}/join', [TontineController::class, 'join'])->name('tontines.join');
    Route::post('tontines/{tontine}/quit', [TontineController::class, 'quit'])->name('tontines.quit');

    // Tirages
    Route::get('/tirages', [TirageController::class, 'index'])->name('tirages.index');
    Route::post('/tirages', [TirageController::class, 'tirage'])->name('tirages.tirage');

    //creation Notification
    Route::get('/notifications/create', [NotificationController::class, 'create'])->name('notifications.create');
    Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');
    Route::get('/notifications/{notification}', [NotificationController::class, 'show'])->name('notifications.show');

 // Notifications
    Route::prefix('notifications')->middleware('auth')->group(function() {
        Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
        Route::post('/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])
            ->name('notifications.mark-as-read');
        Route::post('/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])
            ->name('notifications.mark-all-as-read');
            //recherche utilisateurs
            Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
});

});

//S'agissant du CGU , Contrat et à propos
Route::get('/cgu', [PageController::class, 'cgu'])->name('cgu');
Route::get('/confidentialite', [PageController::class, 'confidentialite'])->name('confidentialite');
Route::get('/contrat', [PageController::class, 'contrat'])->name('contrat');
Route::get('/a-propos', [PageController::class, 'aPropos'])->name('apropos');
//Route::get('/a-propos', [InscriptionController::class, 'aPropos'])->name('apropos');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'sendContact'])->name('contact.send');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');


// Routes pour la création de notifications
Route::middleware(['auth'])->group(function () { // Restreindre l'accès si nécessaire

});

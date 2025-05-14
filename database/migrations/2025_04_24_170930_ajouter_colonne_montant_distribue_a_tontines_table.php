<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AjouterColonneMontantDistribueATontinesTable extends Migration
{
    /**
     * Exécuter les migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tontines', function (Blueprint $table) {
            // Ajouter une colonne "montant_distribue" pour enregistrer le montant distribué dans chaque tontine
            $table->decimal('montant_distribue', 15, 2)->default(0)->after('montant_total')
                ->comment('Montant total distribué dans cette tontine');
        });
    }

    /**
     * Annuler les migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tontines', function (Blueprint $table) {
            $table->dropColumn('montant_distribue');
        });
    }
}

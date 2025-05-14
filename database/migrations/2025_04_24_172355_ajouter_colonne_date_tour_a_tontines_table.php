<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AjouterColonneDateTourATontinesTable extends Migration
{
    /**
     * Exécuter les migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tontines', function (Blueprint $table) {
         $table->date('date_tour')->nullable()->after('montant_distribue')
                ->comment('Date prévue ou effective du tour');
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
            $table->dropColumn('date_tour');
        });
    }
}

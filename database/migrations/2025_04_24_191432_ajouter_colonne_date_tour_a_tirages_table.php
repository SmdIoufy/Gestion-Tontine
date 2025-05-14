<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AjouterColonneDateTourATiragesTable extends Migration
{
    /**
     * Exécuter les migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tirages', function (Blueprint $table) {
            $table->date('date_tour')->nullable()->after('idUser')
                ->comment('Date prévue ou effective du tirage');
        });
    }

    /**
     * Annuler les migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tirages', function (Blueprint $table) {
            $table->dropColumn('date_tour');
        });
    }
}

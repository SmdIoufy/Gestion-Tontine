<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdtontineToPaiementsTable extends Migration
{
    /**
     * Exécuter les modifications sur la table.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->unsignedBigInteger('idtontine')->nullable();

            $table->foreign('idtontine')
                  ->references('id')->on('tontines')
                  ->onDelete('cascade');
        });
    }

    /**
     * Annuler les modifications sur la table.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->dropForeign(['idtontine']);
            $table->dropColumn('idtontine');
        });
    }
}

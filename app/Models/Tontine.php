<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tontine extends Model
{
    protected $fillable = [
        'frequence',
        'libelle',
        'dateDebut',
        'dateFin',
        'description',
        'montant_total',
        'montant_de_base',
        'nbreParticipant'
    ];
}

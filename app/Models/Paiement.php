<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'idUser',
        'montant',
        'idTontine',
        'preuve_paiement',
        'date_paiement'
    ];

    public function tontine()
    {
        return $this->belongsTo(Tontine::class, 'idTontine');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}

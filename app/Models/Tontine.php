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
    protected $casts = [
        'dateDebut' => 'datetime',
        'dateFin' => 'datetime',
    ];

    public function participants()
    {
        return $this->belongsToMany(User::class, 'tontine_user', 'tontine_id', 'user_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'idTontine');
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'idtontine');
    }

    public function beneficiaire()
    {
        return $this->belongsTo(User::class, 'idUser');
    }


    public function tirages()
    {
        return $this->hasMany(Tirage::class, 'idtontine');
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

}

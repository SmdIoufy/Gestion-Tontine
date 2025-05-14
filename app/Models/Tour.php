<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'tontine_id', 'numero', 'dateDebut', 'dateFin', 'beneficiaire_id'
    ];

    public function tontine()
    {
        return $this->belongsTo(Tontine::class);
    }

    public function beneficiaire()
    {
        return $this->belongsTo(User::class, 'beneficiaire_id');
    }
}

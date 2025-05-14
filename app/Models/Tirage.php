<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tirage extends Model
{
    use HasFactory;

    protected $fillable = [
        'idUser',
        'idTontine'
    ];

    public function tontine()
    {
        return $this->belongsTo(Tontine::class, 'idTontine');
    }

    public function beneficiaire()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}


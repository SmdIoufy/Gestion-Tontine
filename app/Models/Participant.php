<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'idUser',
        'dateNaissance',
        'cni',
        'adresse',
        'imageCni'
    ];
}

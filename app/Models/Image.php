<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'idTontine',
        'nomImage'
    ];

    public function tontine()
    {
        return $this->belongsTo(Tontine::class, 'idTontine');
    }


    public function getUrlAttribute()
    {
        return asset('storage/images/' . $this->nomImage);
    }
}

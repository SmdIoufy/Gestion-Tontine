<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use Notifiable;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'prenom',
        'nom',
        'telephone',
        'email',
        'password',
        'profil'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    //Mes Modifications
    public function tontines()
    {
        return $this->belongsToMany(Tontine::class, 'cotisations')->withPivot('montant', 'moyen_paiement');
    }

    public function paiments()
    {
        return $this->hasMany(Paiement::class, 'idUser');
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'idUser');
    }


    public function scopeWithParticipations($query)
    {
        return $query->whereHas('participations');
    }

    public function scopeTreasurers($query)
    {
        return $query->whereHas('roles', function($q) {
            $q->where('name', 'trésorier');
        });
    }

    public function participations()
    {
        return $this->hasMany(Participation::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->prenom} {$this->nom}";
    }

    public function customNotifications()
    {
        return $this->belongsToMany(CustomNotification::class, 'custom_notification_user', 'user_id', 'notification_id')
                    ->withPivot('read')
                    ->withTimestamps();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message',
        'priority',
        'sender_id',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recipients()
    {
        return $this->belongsToMany(User::class, 'custom_notification_user', 'notification_id', 'user_id')
                    ->withPivot('read')
                    ->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'title',
        'message',
        'type',
        'reference_id'
    ];

    public function users()
{
    return $this->belongsToMany(User::class)
        ->withPivot('is_read')
        ->withTimestamps();
}

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $table = 'fields';

    protected $fillable = [
        'name',
        'active',
        'price',
        'member_price',
        'special_days',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function times()
    {
        return $this->hasMany(Time::class);
    }
}

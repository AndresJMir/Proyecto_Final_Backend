<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'charging_point_id',
        'evidence',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chargingPoint()
    {
        return $this->belongsTo(ChargingPoint::class);
    }
}

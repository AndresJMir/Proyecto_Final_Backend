<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ChargingPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'type',
        'power',
        'created_by',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}

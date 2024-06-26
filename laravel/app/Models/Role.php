<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const ADMIN = 1;
    const EDITOR = 2;
    const USUARIO  = 3;

    protected $fillable = [
        'id',
        'name',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Viewer extends Authenticatable
{
    use HasFactory;
    protected $guard = 'viewer';
    protected $table = 'viewers';
    protected $primaryKey = 'id';
    //public $incrementing = false;
    //public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'last_login',
    ];

    protected $hidden = [
        'password',
    ];
}

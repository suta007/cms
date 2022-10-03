<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $primaryKey = 'id';
    //public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'value',
    ];
}

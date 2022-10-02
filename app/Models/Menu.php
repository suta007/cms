<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $primaryKey = 'id';
    //public $incrementing = false;
    //public $timestamps = false;

    protected $fillable = [
        'parent_id',
        'name',
        'icon',
        'route',
        'ordering',
        'guard',
    ];

    public function childs()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id')->orderBy('ordering', 'asc');
    }
}

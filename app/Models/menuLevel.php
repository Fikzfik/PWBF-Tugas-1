<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menuLevel extends Model
{
    protected $table = 'menu_level';
    protected $primaryKey = 'id_level';
    protected $fillable = [
        'level',
        'create_at',
        'update_at'
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class,'id_level', 'id_level');
    }
    
}

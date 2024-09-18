<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisUser extends Model
{
    use HasFactory;

    protected $table = 'jenis_user';
    protected $primaryKey = 'id_jenis_user';

    protected $fillable = [
        'nama_jenis_user',
    ];

    // Relasi one-to-many ke User
    public function users()
    {
        return $this->hasMany(User::class, 'id_jenis_user');
    }

    // Relasi many-to-many ke Menu
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'setting_menu_user', 'id_jenis_user', 'menu_id');
    }
}

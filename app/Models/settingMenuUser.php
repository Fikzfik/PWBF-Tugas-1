<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingMenuUser extends Model
{
    use HasFactory;

    protected $table = 'setting_menu_user';
    protected $primaryKey = 'no_setting';

    protected $fillable = [
        'user_id',
        'menu_id',
        'create_date',
        'delete_mark',
        'update_by',
        'update_date',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}

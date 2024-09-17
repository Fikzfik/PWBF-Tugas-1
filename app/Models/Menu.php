<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $primaryKey = 'menu_id';
   protected $fillable = [
        'menu_name',
        'menu_link',
        'menu_icon',
        'id_level',
        'parent_id',
        'create_by',
        'create_date',
        'delete_mark',
        'update_by',
        'update_date',
        'menunya'
    ];
    public function menuLevel(): BelongsTo
    {
        return $this->belongsTo(MenuLevel::class, 'menu_level_id');
    }

    // Define the relationship with SettingMenuUser
    public function settingMenuUsers(): BelongsToMany
    {
        return $this->belongsToMany(SettingMenuUser::class, 'menu_setting_user', 'menu_id', 'setting_menu_user_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'setting_menu_user', 'menu_id', 'id_jenis_user');
    }
}

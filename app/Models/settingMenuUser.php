<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class settingMenuUser extends Model
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
        'update_date'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with Menu
    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'menu_setting_user', 'setting_menu_user_id', 'menu_id');
    }
}


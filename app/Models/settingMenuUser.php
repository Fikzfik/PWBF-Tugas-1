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
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'menu_id');
    }

    /**
     * Get the jenis user associated with the setting menu user.
     */
    public function jenisUser(): BelongsTo
    {
        return $this->belongsTo(JenisUser::class, 'id_jenis_user', 'id_jenis_user');
    }
}

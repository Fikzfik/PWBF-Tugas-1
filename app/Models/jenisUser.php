<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenisUser extends Model
{
    protected $table = 'jenis_user';
    protected $primaryKey = 'id_jenis_user';
    protected $fillable = [
        'id_jenis_user',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'id_jenis_user');
    }

    // Define the relationship with SettingMenuUser
    public function settingMenuUsers(): HasMany
    {
        return $this->hasMany(SettingMenuUser::class);
    }
}

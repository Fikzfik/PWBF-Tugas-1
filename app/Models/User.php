<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'id_jenis_user',
        'no_hp'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function isAdmin()
    {
        return $this->role === 'Admin';
    }
     // Define the relationship with JenisUser
     public function jenisUser(): BelongsTo
    {
        return $this->belongsTo(JenisUser::class, 'id_jenis_user');
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'setting_menu_user', 'id_jenis_user', 'menu_id');
    }
    // Define the relationship with SettingMenuUser
    public function settingMenuUser(): HasOne
    {
        return $this->hasOne(SettingMenuUser::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'id_jenis_user',
        'no_hp'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relasi many-to-one ke JenisUser
    public function jenisUser()
    {
        return $this->belongsTo(JenisUser::class, 'id_jenis_user');
    }

    // Menentukan apakah user adalah admin
    public function isAdmin()
    {
        return $this->role === 'Admin';
    }
    // public function massage(){
    //     return
    // }
    public function postings()
    {
        return $this->hasMany(Posting::class, 'sender', 'user_id');
    }

    /**
     * Mendefinisikan relasi satu ke banyak dengan model PostingLike.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postingLikes()
    {
        return $this->hasMany(PostingLike::class, 'user_id', 'user_id');
    }

    /**
     * Mendefinisikan relasi satu ke banyak dengan model PostingKomentar.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postingComments()
    {
        return $this->hasMany(PostingKomen::class, 'user_id', 'user_id');
    }
}

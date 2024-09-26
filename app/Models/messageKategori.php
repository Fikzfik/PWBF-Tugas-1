<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageKategori extends Model
{
    use HasFactory;

    protected $table = 'massage_kategori';
    protected $primaryKey = 'no_mk';

    protected $fillable = [
        'description',
    ];

    public function massages()
    {
        return $this->hasMany(Massage::class, 'no_mk');
    }
}

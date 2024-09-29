<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'massage';
    protected $primaryKey = 'massage_id';

    protected $fillable = [
        'massage_reference',
        'subject',
        'text',
        'massage_text',
        'massage_status',
        'no_mk',
        'user_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(MessageKategori::class, 'no_mk');
    }

    public function dokumen()
    {
        return $this->hasMany(MessageDokumen::class, 'massage_id');
    }

    public function to()
    {
        return $this->hasMany(MessageTo::class, 'massage_id');
    }
}

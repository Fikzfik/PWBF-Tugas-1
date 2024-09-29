<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageDokumen extends Model
{
    use HasFactory;

    protected $table = 'massage_dokumen';
    protected $primaryKey = 'no_mdok';

    protected $fillable = [
        'file',
        'description',
        'massage_id',
    ];

    public function message()
    {
        return $this->belongsTo(Massage::class, 'massage_id');
    }
}

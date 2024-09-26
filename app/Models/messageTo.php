<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageTo extends Model
{
    use HasFactory;

    protected $table = 'massage_to';
    protected $primaryKey = 'no_record';

    protected $fillable = [
        'to',
        'cc',
        'massage_id',
    ];

    public function massage()
    {
        return $this->belongsTo(Massage::class, 'massage_id');
    }
}

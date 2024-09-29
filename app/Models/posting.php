<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PostingLike;
use App\Models\PostingKomentar; 

class Posting extends Model
{
    use HasFactory;

    protected $table = 'posting';
    protected $primaryKey = 'posting_id';

    protected $fillable = [
        'sender',
        'message_text',
        'message_gambar',
        'CREATE_BY',
        'CREATE_DATE',
        'DELETE_MARK',
        'UPDATE_BY',
        'UPDATE_DATE'
    ];

    // Menetapkan nama kolom timestamp yang berbeda
    const CREATED_AT = 'CREATE_DATE';
    const UPDATED_AT = 'UPDATE_DATE';

    public function user()
    {
        return $this->belongsTo(User::class, 'sender', 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(PostingLike::class, 'posting_id'); // Pastikan PostingLike::class benar
    }

    public function comments()
    {
        return $this->hasMany(PostingKomen::class, 'posting_id');
    }
}

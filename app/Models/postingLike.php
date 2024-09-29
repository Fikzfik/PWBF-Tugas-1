<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostingLike extends Model
{
    use HasFactory;

    protected $table = 'posting_like';
    protected $primaryKey = 'like_id';

    protected $fillable = [
        'posting_id',
        'user_id',
        'create_by',
        'create_date',
        'delete_mark',
        'update_by',
        'update_date'
    ];
    const CREATED_AT = 'CREATE_DATE';
    const UPDATED_AT = 'UPDATE_DATE';
    public function posting()
    {
        return $this->belongsTo(Posting::class, 'posting_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}

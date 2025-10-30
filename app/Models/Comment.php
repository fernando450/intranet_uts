<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'new_id',
        'user_id',
        'comment',
        'state',
    ];

    // Relación con noticia
    public function news()
    {
        return $this->belongsTo(News::class, 'new_id');
    }

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

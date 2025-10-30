<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files_new';

    protected $fillable = [
        'new_id',
        'file_route',
    ];

    // Relación con noticia
    public function news()
    {
        return $this->belongsTo(News::class, 'new_id');
    }
}

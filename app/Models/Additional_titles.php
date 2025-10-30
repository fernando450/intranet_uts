<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Additional_titles extends Model
{
    //
    protected $table = 'additional_titles';
    protected $fillable = ['teacher_id', 'title', 'institution', 'graduation_year'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';

    protected $fillable = [
        'user_id',
        'professional_title',
        'research_lines',
        'linking_type',
        'state',
        'assigned_subjects',
        'second_email',
        'second_phone',
        'linkedin',
    ];

    //Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function additional_titles()
    {
        return $this->hasMany(Additional_titles::class , 'teacher_id');
    }
}

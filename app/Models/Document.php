<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    //
    use HasFactory;
    protected $table = 'documents';
    protected $fillable = [
        'code',
        'title',
        'file_route',
        'description',
        'issue_date',
        'expiration_date',
        'version',
        'profile',
        'state',
    ];

    //scope

    //Estado
    public function scopeState($query, $state)
    {   
        if(!empty($state)){
            return $query->where('state', $state);
        }
    }

    //Perfil
    public function scopeProfile($query, $profile)
    {
        if(!empty($profile)){
            return $query->where('profile', $profile);
        }
    }

    //title
    public function scopeTitle($query, $title)
    {
        if(!empty($title)){
            return $query->where('title', 'like', "%$title%");
        }
    }
}

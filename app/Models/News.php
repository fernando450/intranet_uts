<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'expiration_date',
        'state',
        'profile',
        'link',
    ];

    // Relación con comentarios
    public function comments()
    {
        return $this->hasMany(Comment::class, 'new_id');
    }

    // Relación con archivos
    public function files()
    {
        return $this->hasMany(File::class, 'new_id');
    }

    public function scopeState($query, $state){
        if(!empty($state)){
            $state = ($state == 'Inactiva') ? 0 : 1;
            $query->where("state", $state);
        }
    }
    public function scopeProfile($query, $profile){
        if(!empty($profile)){
            $query->where("profile", $profile);
        }
    }
    public function scopeTitle($query,$title){
        if(!empty($title)){
            $query->where("title", "like", "%$title%")
            ->orWhere('subtitle',"like", "%$title%");
        }
    }

}

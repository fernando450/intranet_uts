<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable , HasRoles;
    public static $guard_name = "web";

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'document_number',
        'contact_number',
        'state',
        'avatar_route',
        'password',
        'type_profile'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function teacher(){
        return $this->hasOne(Teacher::class);
    }

    public function scopeRole($query, $rol)
    {
        if (empty($rol)) {
            return $query;
        }

        // Normalizar a array
        $roles = is_array($rol) ? $rol : [$rol];

        return $query->whereHas('roles', function ($q) use ($roles) {
            $q->whereIn('name', $roles);
        });
    }

    public function scopeState($query, $state){
        if(!empty($state)){
            $query->where("state", $state);
        }
    }
    public function scopeSearch($query,$data){
        if(!empty($data)){
            $query->where("name", "like", "%$data%")
            ->orWhere('document_number',"like", "%$data%");
        }
    }
}

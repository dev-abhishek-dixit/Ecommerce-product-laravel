<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
     public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withPivot('role_id');;
    }
    public function permission()
    {
        return $this->hasManyThrough(
            Permission::class,
             RoleUser::class, 
        'role_id', // Foreign key on 2nd
        'role_id', // Foreign key on the 1st table
        'id', // Local key on current table
        'user_id' // Local key on 2nd
        );
    }

    public function HasPermission($requestedurl){
    return $this->permission->contains('slug',$requestedurl);
    }
}

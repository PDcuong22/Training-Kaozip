<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password'];

    // Define the relationship with the Post model
    public function posts(){
        return $this->hasMany(Post::class);
    }

    // Define the relationship with the Role model
    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function hasRole($roleName){
        return $this->roles()->contains('name', $roleName);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'email'];

    // Define the relationship with the Post model
    public function posts(){
        return $this->hasMany(Post::class);
    }

    // Define the relationship with the Role model
    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}

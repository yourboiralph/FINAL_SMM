<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['position'];

    /**
     * Define the relationship between Role and User.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role'); // Role is the foreign key in the User table
    }
}

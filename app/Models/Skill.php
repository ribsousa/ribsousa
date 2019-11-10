<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Skill extends Model
{
    protected $fillable = ['name'];

    /**
     * The skills that belong to the user.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

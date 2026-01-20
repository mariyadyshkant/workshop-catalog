<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['name', 'surname', 'email', 'bio'];
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}

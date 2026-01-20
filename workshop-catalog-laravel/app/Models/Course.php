<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'description', 'duration_hours', 'requirements', 'status',
    'start_date', 'end_date', 'language','delivery_mode','category_id', 'level_id', 'teacher_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}

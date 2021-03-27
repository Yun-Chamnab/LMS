<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\Class;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class_id', 'teacher_id', 'teacher_name', 'title', 'description'
    ];
    use SoftDeletes;


    // public function question()
    // {
    //     return $this->hasMany(Question::class);
    // }

    // public function answer()
    // {
    //     return $this->hasMany(Answer::class);
    // }
}

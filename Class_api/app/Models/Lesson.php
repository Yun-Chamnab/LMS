<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\Class;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id','lesson','description', 'file_path',
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

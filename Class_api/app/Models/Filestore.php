<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\Class;
use Illuminate\Database\Eloquent\SoftDeletes;

class Filestore extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lesson_id', 'file_path', 'video_link'
    ];
    // use SoftDeletes;


    // public function question()
    // {
    //     return $this->hasMany(Question::class);
    // }

    // public function answer()
    // {
    //     return $this->hasMany(Answer::class);
    // }
}

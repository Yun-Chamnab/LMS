<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lesson_uuid', 'video_link'
    ];
    // use SoftDeletes;


    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    // public function answer()
    // {
    //     return $this->hasMany(Answer::class);
    // }
}

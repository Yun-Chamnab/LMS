<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\SoftDeletes;

class Filestore extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lesson_uuid', 'file_path'
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classservice;
use App\Models\Lesson;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UsesUuid;

class Course extends Model
{

    use UsesUuid;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class_id', 'teacher_id', 'teacher_name', 'title', 'description', 'image_path',
    ];
    // use SoftDeletes;


    protected $guarded = ['uuid'];

    public function product($id)
    {
        return $this->with($this->with)->findOrFail($id);
    }

    public function classes()
    {
        return $this->hasMany(Classservice::class);
    }

    public function lesson()
    {
        return $this->hasMany(Lesson::class, "course_id");
    }
}

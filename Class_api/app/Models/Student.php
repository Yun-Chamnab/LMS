<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classservice;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'student_name', 'class_id'
    ];
    // use SoftDeletes;


    public function classes()
    {
        return $this->hasMany(Classservice::class);
    }

    // public function answer()
    // {
    //     return $this->hasMany(Answer::class);
    // }
}

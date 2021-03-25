<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'duration', 'publish'
    ];
    use SoftDeletes;
    protected $timeFormat = 'i:s';

    public function question()
    {
        return $this->hasMany(Question::class);
    }

    // public function answer()
    // {
    //     return $this->hasMany(Answer::class);
    // }
}
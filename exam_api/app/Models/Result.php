<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\Exam;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'student_name', 'quiz_id', 'score', 'total_score'
    ];
    use SoftDeletes;


    public function question()
    {
        return $this->hasMany(Question::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Exam::class, "quiz_id");
    }
}

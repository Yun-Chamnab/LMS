<?php

namespace App\Models;

use App\Models\Question;
use App\Models\Exam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    protected $fillable = [
        'question_id',
        'answer',

    ];
    use SoftDeletes;
    public function question()
    {
        // return $this->hasMany(Question::class, 'question_id');
        return $this->belongsTo(Question::class);
    }

    // public function exam()
    // {
    //     return $this->belongsTo(Exam::class);
    // }
}

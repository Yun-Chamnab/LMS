<?php

namespace App\Models;

use App\Models\Answer;
use App\Models\Exam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    protected $fillable = [
        'question',
        'exam_id',
        'score',
    ];
    use SoftDeletes;
    public function answer()
    {
        return $this->hasMany(Answer::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
}

<?php

namespace App\Models;

use App\Models\Answer;
use App\Models\Exam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UsesUuid;

class Question extends Model
{
    use UsesUuid;

    protected $fillable = [
        'question',
        'exam_id',
        'score',
    ];
    use SoftDeletes;
    public function answer()
    {
        return $this->hasMany(Answer::class, 'question_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    protected $guarded = ['uuid'];

    public function product($id)
    {
        return $this->with($this->with)->findOrFail($id);
    }
}

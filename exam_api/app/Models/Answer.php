<?php

namespace App\Models;

use App\Models\Question;
use App\Models\Exam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use App\Traits\UsesUuid;

class Answer extends Model
{
    // use UsesUuid;

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

    // protected $guarded = ['uuid'];

    // public function product($id)
    // {
    //     return $this->with($this->with)->findOrFail($id);
    // }
}

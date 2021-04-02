<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UsesUuid;

class Exam extends Model
{
    use UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id', 'name', 'duration', 'publish'
    ];
    use SoftDeletes;
    protected $timeFormat = 'i:s';

    public function question()
    {
        return $this->hasMany(Question::class, 'uuid');
    }

    protected $guarded = ['uuid'];

    public function product($id)
    {
        return $this->with($this->with)->findOrFail($id);
    }
}

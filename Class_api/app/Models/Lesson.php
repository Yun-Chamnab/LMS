<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Filestore;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UsesUuid;

class Lesson extends Model
{

    use UsesUuid;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id', 'lesson', 'description', 'file_path',
    ];
    use SoftDeletes;


    public function filestore()
    {
        return $this->hasMany(Filestore::class, "lesson_uuid");
    }

    protected $guarded = ['uuid'];

    public function product($id)
    {
        return $this->with($this->with)->findOrFail($id);
    }
}

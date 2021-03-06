<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Course;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UsesUuid;
use DB;

class Classservice extends Model
{

    use UsesUuid;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class_name', 'description', 'color'
    ];
    // use SoftDeletes;


    protected $guarded = ['uuid'];

    public function product($id)
    {
        return $this->with($this->with)->findOrFail($id);
    }

    public function courses()
    {
        return $this->hasMany(Course::class, "class_id");
    }

    public function stuperclass()
    {
        return $this->hasMany(Student::class, "class_id");
    }
}

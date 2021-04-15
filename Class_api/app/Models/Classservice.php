<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\Class;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UsesUuid;

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
    use SoftDeletes;


    protected $guarded = ['uuid'];

    public function product($id)
    {
        return $this->with($this->with)->findOrFail($id);
    }
}

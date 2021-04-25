<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    // public function delete()
    // {
    //     // delete all related photos 
    //     // $this->photos()->delete();
    //     // as suggested by Dirk in comment,
    //     // it's an uglier alternative, but faster
    //     Course::where("class_id", $this->uuid)->delete();

    //     Course::join('table2', 'table1.id', 'table2.foreignId')
    //     ->where('table2.id', 1337)
    //     ->delete();


    //     // delete the user
    //     return parent::delete();
    // }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SahusoftCom\EloquentImageMutator\EloquentImageMutatorTrait;

class News extends Model
{
    use EloquentImageMutatorTrait;

    /**
     * The photo fields should be listed here.
     *
     * @var array
     */
    protected $image_fields = ['image'];

    protected $fillable = ['user_id','image','title','description','important','published','created_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

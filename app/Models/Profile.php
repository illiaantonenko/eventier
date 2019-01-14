<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SahusoftCom\EloquentImageMutator\EloquentImageMutatorTrait;

class Profile extends Model
{
    use EloquentImageMutatorTrait;

    /**
     * The photo fields should be listed here.
     *
     * @var array
     */
    protected $image_fields = ['image'];

    protected $fillable = ['user_id','firstname','middlename','lastname','nickname','image','birthdate','hideyear','phone'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

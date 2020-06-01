<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SahusoftCom\EloquentImageMutator\EloquentImageMutatorTrait;

/**
 * This is the model class for table "birthdays".
 *
 * @property integer $id
 * @property string $image
 * @property string $title
 * @property string $description
 * @property integer $published
 * @property integer $important
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class News extends Model
{

    protected $fillable = ['user_id','image','title','description','important','published','created_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

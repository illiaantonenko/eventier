<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SahusoftCom\EloquentImageMutator\EloquentImageMutatorTrait;
/**
 * This is the model class for table "profiles".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $nickname
 * @property string $birthdate
 * @property string $hideyear
 * @property string $phone
 * @property integer $moderated
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
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

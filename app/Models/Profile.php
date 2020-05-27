<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use SahusoftCom\EloquentImageMutator\EloquentImageMutatorTrait;

/**
 * This is the model class for table "profiles".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $nickname
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $user
 */
class Profile extends Model
{

    protected $fillable = ['user_id', 'firstname', 'lastname', 'nickname', 'image', 'phone'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return array
     */
    public function getFillable(): array
    {
        return $this->fillable;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "birthdays".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $date
 * @property integer $published
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class Birthday extends Model
{
    protected $fillable = ['user_id','date','published'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}

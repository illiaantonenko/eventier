<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "birthdays".
 *
 * @property integer $id
 * @property integer $user_id
 * @property Carbon $date
 * @property integer $published
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class Birthday extends Model
{
    protected $fillable = ['user_id','date'];

    protected $dates = ['date'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}

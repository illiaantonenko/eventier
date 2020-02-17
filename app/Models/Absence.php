<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "absences".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $reason
 * @property Carbon $date
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class Absence extends Model
{

    protected $fillable = ['user_id','reason','date'];

    protected $dates = ['date'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

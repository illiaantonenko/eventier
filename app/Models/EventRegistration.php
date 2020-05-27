<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EventRegistration
 * @package App\Models
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $event_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $user
 * @property Event $event
 */
class EventRegistration extends Model
{
    protected $fillable = ['user_id','event_id','come','hash'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function event(){
        return $this->belongsTo(Event::class);
    }

}

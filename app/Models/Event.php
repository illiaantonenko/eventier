<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "birthdays".
 *
 * @property integer $id
 * @property string $start
 * @property string $end
 * @property string $title
 * @property string $description
 * @property string $repeat
 * @property integer $published
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 * @property Category $category
 */
class Event extends Model
{

    protected $fillable = ['start','end','title','description','user_id','category_id','repeat','published'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function eventRegistration(){
        return $this->hasMany(EventRegistration::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @property  integer $id
 * @property  string $name
 * @property  string $textColor
 * @property  string $color
 */
class EventCategory extends Model
{
    protected $fillable = ['name','textColor','color'];

    public function event(){
        return $this->belongsToMany(Event::class);
    }
}

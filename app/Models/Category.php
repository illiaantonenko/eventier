<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','textColor','color'];

    public function event(){
        return $this->belongsToMany(Event::class);
    }
}

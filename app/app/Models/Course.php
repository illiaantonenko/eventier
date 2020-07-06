<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Course
 * @package App\Models
 *
 * @property string $title
 * @property string $description
 *
 * @property Group [] $groups
 * @property User $user
 */
class Course extends Model
{
    protected $fillable = [
        'title', 'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'groups_courses');
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}

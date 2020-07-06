<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Group
 * @package App\Models
 *
 * @property string $title
 * @property string $description
 *
 * @property User [] $users
 * @property Course [] $courses
 */
class Group extends Model
{
    protected $fillable = [
        'title', 'description'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'groups_courses');
    }
}

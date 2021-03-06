<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $email
 * @property string $role
 * @property integer $moderated
 * @property string $password
 * @property integer $created_at
 * @property integer $updated_at
 *
 * // additional attributes
 * @property string $fullName
 *
 * @property Profile $profile
 * @property Birthday $birthday
 * @property Absence[] $absences
 */
class User extends Authenticatable implements MustVerifyEmail
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'moderated'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'full_name'
    ];


    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function event()
    {
        return $this->hasMany(Event::class);
    }

    public function birthday()
    {
        return $this->hasOne(Birthday::class);
    }

    public function eventRegistration()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function getFullNameAttribute()
    {
        return $this->profile->firstname . " " . $this->profile->lastname;
    }

    /**
     * Return link to profile image if has
     * @return string|null
     */
    public function getProfileImage()
    {
        return $this->profile->image->profile->url;
    }

    /**
     * Return link to small image if has
     * @return string|null
     */
    public function getProfileImageSmall()
    {
        return $this->profile->image->small->url;
    }

    /**
     * Return link to x-small image if has
     * @return string|null
     */
    public function getProfileImageXSmall()
    {
        return $this->profile->image->xsmall->url;
    }

    public function is($roleName)
    {
        foreach ($this->roles()->get() as $role) {
            if ($role->name == $roleName) {
                return true;
            }
        }

        return false;
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "birthdays".
 *
 * @property integer $id
 * @property Carbon $start
 * @property Carbon $end
 * @property string $title
 * @property string $description
 * @property string $repeat
 * @property string $place
 * @property string $qrc
 * @property integer $published
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 * @property EventCategory $category
 */
class Event extends Model
{

    protected $fillable = [
        'start', 'end', 'title', 'description', 'user_id',
        'category_id', 'repeat', 'published', 'qrc', 'place'
    ];

    protected $dates = ['start', 'end'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(EventCategory::class);
    }

    public function eventRegistration()
    {
        return $this->hasMany(EventRegistration::class);
    }

    /**
     * @param $params
     * @return Builder
     */
    public static function search($params)
    {
        $published = $params['published'] ?? null;
        $user = $params['user'] ?? null;
        $sort = $params['sort'] ?? null;
        $order = $params['order'] ?? 'asc';

        /** @var Builder $query */
        $query = Event::query()->when(isset($published), function ($query) use ($published) {
            /** @var Builder $query */
            $query->where(['published' => $published]);
        })->when($sort, function ($query, $sort) use ($order) {
            /** @var Builder $query */
            $query->orderBy($sort, $order);
        }, function ($query) {
            /** @var Builder $query */
            $query->latest();
        })->when($user, function ($query, $user) {
            /** @var Builder $query */
            $query->where(['user_id' => $user]);
        });

        return $query;

    }
}

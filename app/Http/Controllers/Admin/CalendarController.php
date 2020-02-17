<?php

namespace App\Http\Controllers\Admin;

use App\Models\Absence;
use App\Models\Birthday;
use App\Models\Event;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class CalendarController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $array = [];
        /** @var Event [] $events */
        $events = Event::where('published', '=', '1')->select('id', 'title', 'start', 'end', 'repeat', 'category_id')->with('category')->get();
        foreach ($events as $event) {
            $event->url = route('admin.events.show', ['id' => $event->id]);
            $event->color = $event->category->color;
            $event->textColor = $event->category->textColor;
            $array[] = $event;
        }
        /** @var Absence [] $absences */
        $absences = Absence::orderBy('date', 'DESC')->with('user.profile')->get();
        foreach ($absences as $absence) {
            $absence->title = $absence->user->fullName . ' is absent';
            $absence->start = $absence->date->toDateString();
            $absence->url = route('admin.absences.show', ['id' => $absence->id]);
            $array[] = $absence;
        }
        /** @var Birthday [] $birthdays */
        $birthdays = Birthday::orderBy('date', 'DESC')->with('user.profile')->get();
        foreach ($birthdays as $birthday) {
            $birthday->title = $birthday->user->fullName . ' Birthday';
            $birthday->rrule = [
                'freq' => 'yearly',
                'dtstart' => $birthday->date->toDateString()
            ];
            $birthday->color = 'red';
            $array[] = $birthday;
        }

        $locale = App::getLocale();

        return view('admin.calendar.index', ['events' => json_encode($array), 'locale' => $locale]);
    }
}

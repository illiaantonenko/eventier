<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Birthday;
use App\Models\Event;
use Illuminate\Support\Facades\App;

class CalendarController extends Controller
{
    public function index()
    {
        $array = [];
        $events = Event::where('published', '=', '1')->select('id', 'title', 'start', 'end', 'category_id')->with('category')->get();
        foreach ($events as $event) {
            $event->url = '/events/' . $event->id;
            $event->color = $event->category->color;
            $event->textColor = $event->category->textColor;
            $event->durationEditable = false;
            $event->editable = false;
            $array[] = $event;
        }
        $absences = Absence::orderBy('date', 'DESC')->with('user.profile')->get();
        foreach ($absences as $absence) {
            $absence->title = $absence->user->fullName . ' is absent';
            $absence->start = $absence->date->toDateString();
            $absence->url = '/absences/' . $absence->id;
            $absence->durationEditable = false;
            $absence->editable = false;
            $array[] = $absence;
        }
        $birthdays = Birthday::orderBy('date', 'DESC')->with('user.profile')->get();
        foreach ($birthdays as $birthday) {
            $birthday->title = $birthday->user->fullName . ' Birthday';
            $birthday->rrule = [
                'freq' => 'yearly',
                'dtstart' =>$birthday->date->toDateString()
            ];
            $birthday->color = 'red';
            $birthday->durationEditable = false;
            $birthday->editable = false;
            $array[] = $birthday;
        }

        $locale = App::getLocale();

        return view('calendar.index', ['events' => json_encode($array), 'locale' => $locale]);
    }
}

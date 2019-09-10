<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Event;
use Illuminate\Support\Facades\App;

class CalendarController extends Controller
{
    public function index()
    {
        $array = [];
        $events = Event::where('published', '=', '1')->select('id', 'title', 'start', 'end', 'category_id')->with('category')->get();
        foreach ($events as $event) {
            $event->start = date('Y-m-d\TH:i:s', $event->start);
            $event->end = date('Y-m-d\TH:i:s', $event->end);
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
            $absence->start = date('Y-m-d', $absence->date);
            $absence->url = '/absences/' . $absence->id;
            $array[] = $absence;
        }

        $locale = App::getLocale();

        return view('calendar.index', ['events' => json_encode($array), 'locale' => $locale]);
    }
}

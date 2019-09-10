<?php

namespace App\Http\Controllers\Admin;

use App\Models\Absence;
use App\Models\Birthday;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            $event->url = '/admin/events/' . $event->id;
            $event->color = $event->category->color;
            $event->textColor = $event->category->textColor;
            $array[] = $event;
        }
        $absences = Absence::orderBy('date', 'DESC')->with('user.profile')->get();
        foreach ($absences as $absence) {
            $absence->title = $absence->user->fullName . ' is absent';
            $absence->start = date('Y-m-d', $absence->date);
            $absence->url = '/admin/absences/' . $absence->id;
            $array[] = $absence;
        }
        $birthdays = Birthday::orderBy('date', 'DESC')->with('user.profile')->get();
        foreach ($birthdays as $birthday) {
            $birthday->title = $birthday->user->fullName . ' is absent';
            $birthday->start = date('Y-m-d', $birthday->date);
            $birthday->url = '/admin/absences/' . $birthday->id;
            $array[] = $birthday;
        }

        $locale = App::getLocale();

        return view('admin.calendar.index', ['events' => json_encode($array), 'locale' => $locale]);
    }
}

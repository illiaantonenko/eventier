<?php

namespace App\Http\Controllers\Admin;

use App\Models\Absence;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function index(){
        $array = [];
        $events = Event::where('published','=','1')->select('id','title','start','end','category_id')->with('category')->get();
        foreach ($events as $event){
            $event->start = date('Y-m-dTh:i:s',$event->start);
            $event->end = date('Y-m-dTh:i:s',$event->end);
            $event->url = '/admin/events/'.$event->id;
            $event->color = $event->category->color;
            $event->textColor = $event->category->textColor;
            $array[] = $event;
        }
        $absences = Absence::orderBy('date','DESC')->with('user.profile')->get();
        foreach ($absences as $absence) {
            $absence->title = $absence->user->fullName.' is absent';
            $absence->start = date('Y-m-d',$absence->date);
            $absence->url = '/admin/absences/'.$absence->id;
            $array[] = $absence;
        }

        return view('admin.calendar.index',['events' =>json_encode($array)]);
    }
}

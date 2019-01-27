<?php

namespace App\Http\Controllers;

use App\Mail\RegisterOnEventMail;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::where('published', '=', '1')->orderBy('start', 'DESC')->with('category')->paginate(20);
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $eventRegistrations = EventRegistration::where('event_id', '=', $event->id)->with('user.profile')->orderBy('came','DESC')->orderBy('created_at', 'DESC')->get();
        return view('events.show', compact('event', 'eventRegistrations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

    public function registerUserOnEvent(Event $event)
    {
        if (!EventRegistration::where([['user_id', '=', auth()->user()->id], ['event_id', '=', $event->id]])->first()) {
            $hash = $this->createHash(20);
            $eventRegistration = EventRegistration::create([
                'event_id' => $event->id,
                'user_id' => auth()->user()->id,
                'hash' => $hash
            ]);
            if ($eventRegistration) {
                Mail::to($eventRegistration->user->email)->send(new RegisterOnEventMail($eventRegistration));
                Session::flash('success', 'Congratulations you\'ve registered on event! Check your e-mail for more information. 
                    If you haven\'t received it contact Admin to solve this problem!');
                return redirect('/events');
            }
        } else {
            Session::flash('success', 'You\'ve already registered on this event!');
            return redirect()->back();
        }
    }

    public function checkUserPresence($hash){
        $registration = EventRegistration::where('hash','=',$hash)->first();
        if($registration){
            $registration->came = "1";
            $registration->hash = null;
            if($registration->save()){
                Session::flash('success','Welcome to the event!');
                return redirect('/events/'.$registration->event_id);
            }

        }

    }

    private function createHash($qty){
        $hash = [];
        $alphas = array_merge(range('A', 'Z'), range('a', 'z'), range(0,9));
        for($i=0;$i<$qty;$i+=1){
            $hash[] = $alphas[rand(0,count($alphas) - 1)];
        }
        return implode("", $hash);
    }
}

<?php

namespace App\Http\Controllers;

use App\Mail\RegisterOnEventMail;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|Application|View
     */
    public function index()
    {
        $events = Event::where('published', '=', '1')->orderBy('start', 'DESC')->with('category')->paginate(20);
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @return Factory|Application|View
     */
    public function show(Event $event)
    {
        $eventRegistrations = EventRegistration::where('event_id', '=', $event->id)->with('user.profile')->orderBy('came','DESC')->orderBy('created_at', 'DESC')->get();
        return view('events.show', compact('event', 'eventRegistrations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Event $event
     * @return Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return Response
     */
    public function destroy(Event $event)
    {
        //
    }

    public function registerUserOnEvent(Event $event)
    {
        if (!EventRegistration::where([['user_id', '=', auth()->user()->id], ['event_id', '=', $event->id]])->first()) {
            $hash = Hash::make($event->title);
            $eventRegistration = EventRegistration::create([
                'event_id' => $event->id,
                'user_id' => auth()->user()->id,
                'hash' => $hash
            ]);
            if ($eventRegistration) {
//                Mail::to($eventRegistration->user->email)->send(new RegisterOnEventMail($eventRegistration));
                Session::flash('success', 'Congratulations you\'ve registered on event!');
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

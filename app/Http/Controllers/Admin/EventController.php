<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{
    /**
     * Display a listing of the events.
     *
     * @return \Illuminate\Http\Response
     */
    public function allEvents()
    {
        $events = Event::with('user.profile')->orderBy('id', 'DESC')->paginate(20);
        return view('admin.events.index', compact('events'));
    }

    /**
     * Display a listing of the events.
     *
     * @return \Illuminate\Http\Response
     */
    public function newEvents()
    {
        $events = Event::where('published', '=', '0')->with('user.profile')->orderBy('id', 'DESC')->paginate(20);
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();

        return view('admin.events.create', compact('users', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required|integer',
            'category' => 'required|integer',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'start' => 'required|string',
            'end' => 'nullable|string',
            'published' => 'required|integer',
        ]);

        $event = Event::create([
            'user_id' => $request->user,
            'category_id' => $request->category,
            'title' => $request->title,
            'description' => $request->description,
            'start' => strtotime($request->start),
            'end' => strtotime($request->end),
            'published' => $request->published,
        ]);

        if ($event) {
            Session::flash('success', 'Event created successfully');
            return redirect('/admin/events/all');
        }
    }

    /**
     * Display the specified event.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $eventRegistrations = EventRegistration::where('event_id', '=', $event->id)->with('user.profile')->orderBy('created_at', 'DESC')->get();
        return view('admin.events.show', compact('event', 'eventRegistrations'));
    }

    /**
     * Show the form for editing the specified event.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $users = User::all();
        $categories = Category::all();

        return view('admin.events.edit', compact('users', 'categories', 'event'));
    }

    /**
     * Update the specified event in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'user' => 'required|integer',
            'category' => 'required|integer',
            'title' => 'required|string',
            'description' => 'required|string',
            'start' => 'required|string',
            'end' => 'required|string',
            'published' => 'required|integer',
        ]);

        $event->user_id = $request->user;
        $event->category_id = $request->category;
        $event->title = $request->title;
        $event->description = $request->description;
        $event->start = strtotime($request->start);
        $event->end = strtotime($request->end);
        $event->published = $request->published;

        if ($event->save()) {
            Session::flash('success', 'Event updated');
            return redirect('/admin/events/all');
        }
    }

    /**
     * Remove the specified event from storage.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if (Event::destroy($event->id)) {
            Session::flash('success', 'Post deleted');
            return redirect()->back();
        }
    }

    public function changestatus(Event $event)
    {
        if ($event->published == 0) {
            if ($event->start != null) {
                $event->published = 1;
            } else {
                Session::flash('error', 'You need to fill the start time');
                return redirect()->back();
            }
        } else {
            $event->published = 0;
        }
        $event->save();
        Session::flash('success', 'Status changed');
        return redirect()->back();
    }
}

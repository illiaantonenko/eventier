<?php

namespace App\Http\Controllers\Admin;

use App\Models\EventCategory;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class EventController extends Controller
{

    /**
     * Display a listing of the events.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $events = Event::search($request->all())->with('user.profile')->paginate(30);

        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     *
     * @return Factory|View
     */
    public function create()
    {
        $users = User::all();
        $categories = EventCategory::all();

        return view('admin.events.create', compact('users', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required|integer',
            'category' => 'required|integer',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'place' => 'nullable|string',
            'start' => 'required|string',
            'end' => 'nullable|string',
            'published' => 'required|integer',
        ]);

        $event = Event::create([
            'user_id' => $request->user,
            'category_id' => $request->category,
            'title' => $request->title,
            'description' => $request->description,
            'place' => $request->place,
            'start' => strtotime($request->start),
            'end' => strtotime($request->end),
            'published' => $request->published,
            'qrc' => Hash::make($request->title),
        ]);

        if ($event) {
            Session::flash('success', __('Event created successfully'));
            return redirect(route('admin.events.index'));
        }
    }

    /**
     * Display the specified event.
     *
     * @param Event $event
     * @return Factory|View
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
     * @return Factory|View
     */
    public function edit(Event $event)
    {
        $users = User::all();
        $categories = EventCategory::all();

        return view('admin.events.edit', compact('users', 'categories', 'event'));
    }

    /**
     * Update the specified event in storage.
     *
     * @param Request $request
     * @param Event $event
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'user' => 'required|integer',
            'category' => 'required|integer',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'place' => 'required|string',
            'start' => 'required|string',
            'end' => 'required|string',
            'published' => 'required|integer',
        ]);

        $event->user_id = $request->user;
        $event->category_id = $request->category;
        $event->title = $request->title;
        $event->description = $request->description;
        $event->place = $request->place;
        $event->start = strtotime($request->start);
        $event->end = strtotime($request->end);
        $event->published = $request->published;

        if ($event->save()) {
            Session::flash('success', 'Event updated');
            return redirect(route('admin.events.index'));
        }
    }

    /**
     * Remove the specified event from storage.
     *
     * @param Event $event
     * @return RedirectResponse
     */
    public function destroy(Event $event)
    {
        if (Event::destroy($event->id)) {
            Session::flash('success', 'Event deleted');
        } else {
            Session::flash('error', 'Something went wrong! Event is not deleted');
        }
        return redirect()->back();
    }

    /**
     * @param Event $event
     * @return RedirectResponse
     */
    public function refreshQRC(Event $event)
    {
        if ($event->update(['qrc' => Hash::make($event->title)])) {
            $event->save();
            Session::flash('success', __('QRC regenerated'));
        } else {
            Session::flash('error', 'Ooops, something went wrong');
            return redirect()->back();
        }

        return redirect()->back();
    }

    /**
     * @param Event $event
     * @return RedirectResponse
     */
    public function changeStatus(Event $event)
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

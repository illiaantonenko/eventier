<?php

namespace App\Http\Controllers\Admin;

use App\Mail\ModerationPassedMail;
use App\Mail\WelcomeUserMail;
use App\Models\Birthday;
use App\Models\Course;
use App\Models\Group;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $groups = Group::paginate(20);
        return view('admin.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.courses.create');
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
            'firstname' => 'required|string',
            'middlename' => 'required|string',
            'lastname' => 'required|string',
            'nickname' => 'nullable|string',
            'birthdate' => 'required|string',
            'hideyear' => 'required|integer',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
            'role' => 'required|string',
            'moderated' => 'required|integer',
        ]);

        $group = Group::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'moderated' => $request->moderated,
        ]);

        if ($group) {
            $profile = Profile::create([
                'user_id' => $group->id,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'nickname' => $request->nickname,
            ]);
            $birthday = Birthday::firstOrNew(['user_id' => $group->id]);
            $birthday->date = strtotime($request->birthdate);
            $birthday->save();
            if ($profile) {
                Session::flash('success', 'Group created successfully');
                return redirect(route('admin.course.index'));
            } else {
                if (Group::destroy($group->id)) {
                    Session::flash('error', 'Oops something went wrong');
                } else {
                    Session::flash('error', 'Something went wrong! Profile has not been created and Group is not deleted!');
                }
                return redirect(route('admin.course.index'));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Group $group
     * @return Factory|View
     */
    public function show(Group $group)
    {
        $group->loadMissing(['users']);
        return view('admin.groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Group $group
     * @return Factory|View
     */
    public function edit(Group $group)
    {
        $group->with('profile');
        return view('admin.courses.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Group $group
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, Group $group)
    {
        $request->validate([
            'firstname' => 'required|string',
            'middlename' => 'required|string',
            'nickname' => 'nullable|string',
            'lastname' => 'required|string',
            'phone' => 'nullable|string',
            'birthdate' => 'required|string',
            'email' => 'nullable|email',
            'password' => 'nullable|confirmed',
            'role' => 'required|string',
            'hideyear' => 'required|integer',
            'moderated' => 'required|integer'
        ]);

        if ($group->moderated == 0 && $request->moderated == 1) {
            Mail::to($group->email)->send(new ModerationPassedMail());
        }
        $group->update($request->only(['email', 'role', 'moderated']));

        if ($request->password) {
            $group->password = bcrypt($request->password);
        }

        $group->profile()->update($request->only($group->profile->getFillable()));
        $birthday = Birthday::firstOrNew(['user_id' => $group->id]);
        $birthday->date = strtotime($request->birthdate);
        $birthday->save();

        if ($group->save() && $group->profile->save()) {
        } else {
            Session::flash('error', 'Something went wrong! Group is not updated');
        }
        return redirect(route('admin.course.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @return RedirectResponse
     */
    public function destroy(Group $group)
    {
        if (Group::destroy($group->id)) {
            Session::flash('success', 'Group deleted');
        } else {
            Session::flash('error', 'Something went wrong! Group is not deleted');
        }
        return redirect()->back();
    }
}

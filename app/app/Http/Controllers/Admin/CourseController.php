<?php

namespace App\Http\Controllers\Admin;

use App\Mail\ModerationPassedMail;
use App\Mail\WelcomeUserMail;
use App\Models\Birthday;
use App\Models\Course;
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

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $courses = Course::query()->paginate(20);
        return view('admin.courses.index', compact('courses'));
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

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'moderated' => $request->moderated,
        ]);

        if ($user) {
            $profile = Profile::create([
                'user_id' => $user->id,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'nickname' => $request->nickname,
            ]);
            $birthday = Birthday::firstOrNew(['user_id' => $user->id]);
            $birthday->date = strtotime($request->birthdate);
            $birthday->save();
            if ($profile) {
                Session::flash('success', 'User created successfully');
                return redirect(route('admin.course.index'));
            } else {
                if (User::destroy($user->id)) {
                    Session::flash('error', 'Oops something went wrong');
                } else {
                    Session::flash('error', 'Something went wrong! Profile has not been created and User is not deleted!');
                }
                return redirect(route('admin.course.index'));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Course $course
     * @return Factory|View
     */
    public function show(Course $course)
    {
//        dd($course->user);
//        $course->with(['groups', 'user']);
        $course->loadMissing(['groups', 'user']);
//        dd($course->groups());
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Factory|View
     */
    public function edit(User $user)
    {
        $user->with('profile');
        return view('admin.courses.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, User $user)
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

        if ($user->moderated == 0 && $request->moderated == 1) {
            Mail::to($user->email)->send(new ModerationPassedMail());
        }
        $user->update($request->only(['email', 'role', 'moderated']));

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->profile()->update($request->only($user->profile->getFillable()));
        $birthday = Birthday::firstOrNew(['user_id' => $user->id]);
        $birthday->date = strtotime($request->birthdate);
        $birthday->save();

        if ($user->save() && $user->profile->save()) {
        } else {
            Session::flash('error', 'Something went wrong! User is not updated');
        }
        return redirect(route('admin.course.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $course
     * @return RedirectResponse
     */
    public function destroy(User $course)
    {
        if (User::destroy($course->id)) {
            Session::flash('success', 'User deleted');
        } else {
            Session::flash('error', 'Something went wrong! User is not deleted');
        }
        return redirect()->back();
    }
}

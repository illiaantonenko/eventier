<?php

namespace App\Http\Controllers\Admin;

use App\Mail\ModerationPassedMail;
use App\Mail\WelcomeUserMail;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('profile')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
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
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'nickname' => $request->nickname,
                'birthdate' => strtotime($request->birthdate),
            ]);
            if ($profile) {
                Session::flash('success', 'User created successfully');
                return redirect('/admin/users');
            } else {
                if (User::destroy($user->id)) {
                    Session::flash('error', 'Oops something went wrong');
                    return redirect('/admin/users');
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->with('profile', 'absence');
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->with('profile');
        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'firstname' => 'required|string',
            'middlename' => 'required|string',
            'nickname' => 'nullable|string',
            'lastname' => 'required|string',
            'phone' => 'required|string',
            'birthdate' => 'required|string',
            'email' => 'nullable|email',
            'password' => 'nullable|confirmed',
            'role' => 'required|string',
            'hideyear' => 'required|integer',
            'moderated' => 'required|integer'
        ]);

        if ($request->password){
            $user->password = bcrypt($request->password);
        }

        if ($user->moderated == 0 && $request->moderated == 1){
            Mail::to($user->email)->send(new ModerationPassedMail());
        }
        $user->moderated = $request->moderated;
        $user->role = $request->role;

        $user->profile->firstname = $request->firstname;
        $user->profile->middlename = $request->middlename;
        $user->profile->nickname = $request->nickname;
        $user->profile->lastname = $request->lastname;
        $user->profile->birthdate = strtotime($request->birthdate);
        $user->profile->hideyear = $request->hideyear;
        $user->profile->phone = $request->phone;

        if($user->save() && $user->profile->save()){
            Session::flash('success','User updated!');
            return redirect('/admin/users');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(User::destroy($user->id)){
            Session::flash('success','News deleted');
            return redirect()->back();
        }
    }
}

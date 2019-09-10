<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        $absences = Absence::where('user_id','=', $profile->user->id)->orderBy('date','DESC')->get();
        return view('profile.index',compact('profile','absences'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        if (auth()->user()->id === $profile->user->id){
            return view('profile.update',compact('profile'));
        }else{
            return abort(403, __('messages.unauthorized'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $request->validate([
          'firstname'=>'required|string',
          'lastname'=>'required|string',
          'middlename'=>'nullable|string',
          'nickname'=>'nullable|string',
          'birthdate'=>'required|date',
          'phone'=>'nullable|string',
          'hideyear'=>'required|integer',
        ]);

        $profile->firstname = $request->firstname;
        $profile->lastname = $request->lastname;
        $profile->middlename = $request->middlename;
        $profile->nickname = $request->nickname;
        $profile->birthdate = strtotime($request->birthdate);
        $profile->phone = $request->phone;
        $profile->hideyear = $request->hideyear;

        if($request->file('image')){
            $profile->image = $request->image;
        }

        if($profile->save()){
//            Session::flash('success','Profile updated!');
            return redirect('/user/profile/edit/'.auth()->user()->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }

    public function myProfile()
    {
        $profile = Profile::where('user_id','=',auth()->user()->id)->first();
        return view('profile.update',compact('profile'));
    }
}

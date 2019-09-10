<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Birthday;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class BirthdayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $birthdays = Birthday::with('user')->paginate(30);
        return view('admin.birthdays.index',compact('birthdays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::with('profile')->get();
        return view('admin.birthdays.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'user_id'=>'required|string|unique:birthdays',
           'date'=>'required|string',
           'published'=>'required|integer',
        ]);

        $birthday = Birthday::create([
            'user_id' => $request->user_id,
            'date' => strtotime($request->date),
            'published' => $request->published,
        ]);

        if($birthday){
            Session::flash('success','Birthday celebration created successfully');
            return redirect('/admin/birthdays');
        }else{
            Session::flash('error','Birthday didn\'t saved');
            return redirect('/admin/birthdays');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Birthday  $birthday
     * @return Response
     */
    public function edit(Birthday $birthday)
    {
        $users = User::with('profile')->get();
        return view('admin.birthdays.edit',compact('birthday','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Birthday  $birthday
     * @return Response
     */
    public function update(Request $request, Birthday $birthday)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Birthday  $birthday
     * @return Response
     */
    public function destroy(Birthday $birthday)
    {
        //
    }
}

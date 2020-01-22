<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Birthday;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class BirthdayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $birthdays = Birthday::with('user')->paginate(30);
        return view('admin.birthdays.index', compact('birthdays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $users = User::with('profile')->get();
        return view('admin.birthdays.create', compact('users'));
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
            'user_id' => 'required|string|exists:users,id|unique:birthdays',
            'date' => 'required|string',
            'published' => 'required|integer',
        ]);

        $birthday = Birthday::create([
            'user_id' => $request->user_id,
            'date' => strtotime($request->date),
            'published' => $request->published,
        ]);

        if ($birthday) {
            Session::flash('success', 'Birthday celebration created successfully');
        } else {
            Session::flash('error', "Birthday didn't saved");
        }
        return redirect('/admin/birthdays');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Birthday $birthday
     * @return Factory|View
     */
    public function edit(Birthday $birthday)
    {
        $users = User::with('profile')->get();
        return view('admin.birthdays.edit', compact('birthday', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Birthday $birthday
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, Birthday $birthday)
    {
        $request->validate([
            'user_id' => 'required|string|exists:users,id|unique:birthdays,user_id,'.$birthday->user_id,
            'date' => 'required|date',
            'published' => 'required|integer',
        ]);

        $birthday->user_id = $request->user_id;
        $birthday->date = strtotime($request->date);
        $birthday->published = $request->published;

        if ($birthday->save()) {
            Session::flash('success', 'Birthday celebration updated successfully');
        } else {
            Session::flash('error','Something went wrong! Birthday is not updated');
        }
        return redirect('/admin/birthdays');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Birthday $birthday
     * @return RedirectResponse
     */
    public function destroy(Birthday $birthday)
    {
        if (Birthday::destroy($birthday->id)) {
            Session::flash('success', 'Birthday deleted');
        } else {
            Session::flash('error', 'Something went wrong! Birthday is not deleted');
        }
        return redirect()->back();
    }
}

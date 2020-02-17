<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Birthday;
use App\Models\Profile;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Profile $profile
     * @return Factory|View
     */
    public function show(Profile $profile)
    {
        $profile->load(['user', 'user.absences']);
        return view('profile.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Profile $profile
     * @return Factory|View|void
     */
    public function edit(Profile $profile)
    {
        if (auth()->user()->id === $profile->user->id) {
            return view('profile.edit', compact('profile'));
        } else {
            return abort(403, __('messages.unauthorized'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Profile $profile
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'nickname' => 'nullable|string',
            'birthdate' => 'nullable|date',
        ]);

        $profile->firstname = $request->firstname;
        $profile->lastname = $request->lastname;
        $profile->nickname = $request->nickname;

        $profile->user->birthday()->updateOrCreate(['user_id' => $profile->user->id], ['date' => strtotime($request->birthdate)]);

        if ($request->file('image')) {
            $profile->image = $request->image;
        }

        if ($profile->save()) {
            Session::flash('success', __('Profile updated'));
            return redirect(route('user.profile.show', ['id' => auth()->id()]));
        }
    }
}

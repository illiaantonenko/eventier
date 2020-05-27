<?php

namespace App\Http\Controllers\Admin;

use App\Models\Absence;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $absences = Absence::with('user.profile')->orderBy('date','DESC')->paginate(20);
        return view('admin.absences.index',compact('absences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $users = User::all();
        return view('admin.absences.create',compact('users'));
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
            'user'=>'required|integer',
            'reason'=>'required|string',
            'date'=>'required|string'
        ]);

        $absence = Absence::create([
            'user_id' => $request->user,
            'reason' => $request->reason,
            'date' => strtotime($request->date),
        ]);

        if($absence){
            Session::flash('success','Absence created successfully');
            return redirect('/admin/absences');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Absence $absence
     * @return Factory|View
     */
    public function show(Absence $absence)
    {
        return view('admin.absences.show',compact('absence'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param   Absence $absence
     * @return Factory|View
     */
    public function edit(Absence $absence)
    {
        $users = User::all();
        return view('admin.absences.edit',compact('absence','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param   Absence $absence
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, Absence $absence)
    {
        $request->validate([
            'user'=>'required|integer',
            'reason'=>'required|string',
            'date'=>'required|string',
        ]);

        $absence->user_id = $request->user;
        $absence->reason = $request->reason;
        $absence->date = strtotime($request->date);

        if ($absence->save()){
            Session::flash('success','Absence updated');
        }else{
            Session::flash('error','Something went wrong! Absence is not updated');
        }

        return redirect('/admin/absences');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param   Absence $absence
     * @return RedirectResponse
     */
    public function destroy(Absence $absence)
    {
        if(Absence::destroy($absence->id)){
            Session::flash('success','Absence deleted');
            return redirect()->back();
        }else{
            Session::flash('error','Something went wrong! Absence is not deleted');
            return redirect()->back();
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\News;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $news = News::orderBy('important','DESC')->orderBy('created_at','DESC')->limit(6)->get();
        $absences = Absence::orderBy('created_at','DESC')->with('user.profile')->limit(6)->get();
        return view('dashboard',compact('news','absences'));
    }
}

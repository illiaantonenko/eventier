<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::with('user.profile')->paginate(20);
        return view('admin.news.index',compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.news.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'=>'required|string',
            'description'=>'required|string',
            'user'=>'required|integer',
            'important'=>'required|integer',
            'published'=>'required|integer',
        ]);

        $news = News::create([
            'title'=> $request->title,
            'description'=> $request->description,
            'user_id'=> $request->user,
            'important'=> $request->important,
            'published'=> $request->published,
        ]);

        if($news){
            if($request->file('image')){
                $news->image = $request->image;
                $news->save();
            }
            return redirect('/admin/news');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param   News $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('admin.news.show',compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    News $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $users = User::all();
        return view('admin.news.edit',compact('users','news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param    News $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title'=>'required|string',
            'description'=>'required|string',
            'user'=>'required|integer',
            'important'=>'required|integer',
            'published'=>'required|integer',
        ]);

        $news->title = $request->title;
        $news->description = $request->description;
        $news->user_id = $request->user;
        $news->important = $request->important;
        $news->published = $request->published;

        if($request->file('image')){
            $news->image = $request->image;
        }

        if($news->save()){
            Session::flash('success','News updated');
            return redirect('/admin/news');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param   News $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        if(News::destroy($news->id)){
            Session::flash('success','News deleted');
            return redirect()->back();
        }
    }

    public function changestatus(News $news){
        if($news->published == 0){
            $news->published = 1;
        }else{
            $news->published = 0;
        }
        $news->save();
        Session::flash('success','Status changed');
        return redirect()->back();
    }
}

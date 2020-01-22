<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $news = News::with('user.profile')->paginate(20);
        return view('admin.news.index',compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $users = User::all();
        return view('admin.news.create',compact('users'));
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
            'title'=>'required|string',
            'description'=>'required|string',
            'user'=>'required|integer',
            'important'=>'required|integer',
            'published'=>'required|integer',
        ]);

        /** @var News $news */
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
     * @return Factory|View
     */
    public function show(News $news)
    {
        return view('admin.news.show',compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    News $news
     * @return Factory|View
     */
    public function edit(News $news)
    {
        $users = User::all();
        return view('admin.news.edit',compact('users','news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param    News $news
     * @return RedirectResponse|Redirector
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
        }else{
            Session::flash('error','Something went wrong! News is not updated');
        }
        return redirect('/admin/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param   News $news
     * @return RedirectResponse
     */
    public function destroy(News $news)
    {
        if(News::destroy($news->id)){
            Session::flash('success','News deleted');
        }else{
            Session::flash('error','Something went wrong! News is not deleted');
        }
        return redirect()->back();
    }

    /**
     * @param News $news
     * @return RedirectResponse
     */
    public function changeStatus(News $news){
        if($news->published == 0){
            $news->published = 1;
        }else{
            $news->published = 0;
        }
        if ($news->save()){
            Session::flash('success','Status changed');
        }else{
            Session::flash('error','Something went wrong! Status is not changed');
        }
        return redirect()->back();
    }
}

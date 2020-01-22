<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $categories = Category::paginate(20);
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.categories.create');
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
           'name' => 'required|string',
           'textColor' => 'required|string',
           'color' => 'required|string',
        ]);

        $category = Category::create([
           'name' => $request->name,
           'textColor' => $request->textColor,
           'color' => $request->color,
        ]);

        if ($category){
            Session::flash('success','Category created successfully');
            return redirect('/admin/categories');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category  $category
     * @return RedirectResponse
     */
    public function destroy($category)
    {
        if(Category::destroy($category->id)){
            Session::flash('success','Category deleted');
        }else{
            Session::flash('error','Something went wrong! Category is not deleted');
        }
        return redirect()->back();
    }
}

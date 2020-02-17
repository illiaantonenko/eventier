<?php

namespace App\Http\Controllers\Admin;

use App\Models\EventCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class EventCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $categories = EventCategory::paginate(20);
        return view('admin.eventCategories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.eventCategories.create');
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

        $category = EventCategory::create($request->all());

        if ($category) {
            Session::flash('success', 'EventCategory created successfully');
        } else {
            Session::flash('error', 'Something went wrong! Category is not updated');
        }
        return redirect()->route('admin.events.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EventCategory $category
     * @return Factory|View
     */
    public function edit(EventCategory $category)
    {
        return view('admin.eventCategories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param EventCategory $category
     * @return RedirectResponse
     */
    public function update(Request $request, EventCategory $category)
    {
        $request->validate([
            "name" => "required|string",
            "color" => "required|string",
            "textColor" => "required|string",
        ]);
        $category->update($request->all());
        return redirect()->route('admin.events.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EventCategory $category
     * @return RedirectResponse
     */
    public function destroy(EventCategory $category)
    {
        if (EventCategory::destroy($category->id)) {
            Session::flash('success', 'EventCategory deleted');
        } else {
            Session::flash('error', 'Something went wrong! EventCategory is not deleted');
        }
        return redirect()->back();
    }
}

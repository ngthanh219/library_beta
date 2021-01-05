<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('parent_id', 0)->get();

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryParents = Category::where('parent_id', 0)->get();

        return view('admin.category.create', compact('categoryParents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category;
        if ($request->ajax()) {
            $result_parent = $category->create([
                'name' => $request->parent_name,
                'parent_id' => 0,
            ]);
            $result_child = $category->create([
                'name' => $request->child_name,
                'parent_id' => $result_parent['id'],
            ]);

            return response()->json([
                'dataParent' => $result_parent,
                'dataChild' => $result_child,
            ]);
        } else {
            $result = $category->create([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
            ]);
            if ($result) {
                return redirect()->route('admin.category.index')->with('infoMessage',
                    trans('message.category_create_success'));
            }

            return redirect()->route('admin.category.index')->with('infoMessage',
                trans('message.category_create_fail'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        if ($category->parent_id == 0) {
            $category->load('children');

            return view('admin.category.show', compact('category'));
        }

        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::where('parent_id', 0)->with('children')->get();

        return view('admin.category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $result = $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);
        $parent = $category->load('parent');
        if ($result) {
            if (isset($parent->parent)) {
                return redirect()->route('admin.category.show', $parent['parent']->id)->with('infoMessage',
                    trans('message.category_update_success'));
            }

            return redirect()->route('admin.category.index')->with('infoMessage',
                trans('message.category_update_success'));
        }

        return redirect()->back()->with('infoMessage',
            trans('message.category_update__fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->parent_id == 0) {
            $children = $category->load('children');
            if (!$children->children->isEmpty()) {
                return redirect()->back()->with('infoMessage',
                    trans('message.category_has_children'));
            }
        }
        $result = $category->delete();
        if ($result) {
            return redirect()->back()->with('infoMessage',
                trans('message.category_delete_success'));
        }

        return redirect()->route('admin.category.index')->with('infoMessage',
            trans('message.category_delete__fail'));
    }
}

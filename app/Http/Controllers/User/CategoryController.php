<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->only('name'));
        return redirect()->route('backend.categories.index')
            ->with('success', 'Thêm mới thể loại thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('backend.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->only('name'));
        return redirect()->route('backend.categories.index')
            ->with('success', 'Cập nhật thể loại thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('backend.categories.index')
            ->with('success', 'Xóa thể loại thành công');
    }

    public function trashedCategory()
    {
        return view('backend.categories.trash')
            ->with('categories', Category::withTrashed()->get());
    }

    public function restoreCategory($id)
    {

       Category::withTrashed()
            ->where('id', $id)
            ->restore();
        return redirect()->route('backend.categories.index')
            ->with('success', 'Khôi phục thể loại thành công');
    }

    public function forceDeleteCategory($id)
    {
        Category::withTrashed()
            ->where('id', $id)->forceDelete();
        return redirect()->route('backend.categories.index')
            ->with('success', 'Tiếp tục xóa thể loại thành công');
    }
}

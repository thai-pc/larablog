<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('backend.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = Post::create([
            'title'         => $request->title,
            'content'       => $request->post_content,
            'status'        => $request->status,
            'excerpt'       => $request->excerpt,
            'user_id'       => 18,
            'category_id'   => $request->category_id
        ]);
        return redirect()->route('backend.posts.index')
            ->with('success', "Thêm bài viết thành công");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
    public function trashedPost()
    {
        return view('backend.posts.trash')
            ->with('posts', Post::withTrashed()->get());
    }

    public function restorePost($id)
    {
        Post::withTrashed()
            ->where('id', $id)
            ->restore();
        return redirect()->route('backend.posts.index')
            ->with('success', 'Khôi phục bài viết thành công');
    }

    public function forceDeletePost($id)
    {
        Post::withTrashed()
            ->where('id', $id)->forceDelete();
        return redirect()->route('backend.posts.index')
            ->with('success', 'Tiếp tục xóa bài viết thành công');
    }
}

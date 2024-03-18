<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
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
    public function store(PostRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->post_content,
            'status' => $request->status,
            'excerpt' => $request->excerpt,
            'user_id' => auth()->id(),
            'category_id' => $request->category_id
        ]);

        if ($request->has('tags')) {
            $tags = $request->tags;
            $tags_id = [];

            foreach ($tags as $tag) {
                $tag_model = Tag::where('name', $tag)->first();
                if ($tag_model) {
                    array_push($tags_id, $tag_model->id);
                } else {
                    array_push($tags_id, (Tag::create(['name' => $tag]))->id);
                }
            }

            $post->tags()->sync($tags_id);
        }

        if ($request->hasFile('feature_image')) {
            $post->addMedia($request->feature_image)->toMediaCollection('feature_image');
        }

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
        $this->authorize('update', $post);
        $categories = Category::all();
        $tags = $post->tags()->latest()->get();
        return view('backend.posts.edit', compact(['post', 'categories', 'tags']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->update([
            'title' => $request->input('title', $post->title),
            'content' => $request->input('post_content', $post->content),
            'status' => $request->input('status', $post->status),
            'excerpt' => $request->input('excerpt', $post->excerpt),
            'user_id' => auth()->id(),
            'category_id' => $request->input('category_id', $post->category_id)
        ]);

        // Cập nhật tags
        if ($request->has('tags')) {
            $tags = $request->tags;
            $tags_id = [];
            foreach ($tags as $tag) {
                $tag_model = Tag::where('name', $tag)->first();
                if ($tag_model) {
                    array_push($tags_id, $tag_model->id);
                } else {
                    array_push($tags_id, (Tag::create(['name' => $tag]))->id);
                }
            }

            $post->tags()->sync($tags_id);
        } else {
            $post->tags()->detach();
        }

        if ($request->hasFile('feature_image')) {
            $post->media()->delete();
            $post->addMedia($request->feature_image)
                ->toMediaCollection("feature_image");
        }

        return redirect()->route('backend.posts.index')
            ->with('success', "Cập nhật bài viết thành công");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('backend.posts.index')
            ->with('success', "Xóa bài viết thành công");
    }

    public function trashedPost()
    {
        return view('backend.posts.trash')
            ->with('posts', Post::onlyTrashed()->get());
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
        $post = Post::withTrashed()->where('id', $id)->first();
        $this->authorize('delete', $post);
        preg_match_all('/<img[^>]+src="([^"]+)"[^>]*>/i', $post->content, $matches);

        foreach ($matches[1] as $image) {
            $absolutePath = public_path($image);
            if (file_exists($absolutePath)) {
                unlink($absolutePath);
            }
        }

        if ($post->getMedia('feature_image')->isNotEmpty()) {
            $post->getMedia('feature_image')[0]->delete();
        }
        $post->forceDelete();
        return redirect()->route('backend.posts.index')
            ->with('success', 'Tiếp tục xóa bài viết thành công');
    }

    public function uploadPhoto(Request $request)
    {
        $message = '';
        $url = null;
        $CKEditorFuncNum = $request->input('CKEditorFuncNum');

        if ($request->hasFile('upload')) {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $maxSize = 2 * 1024;

            $uploadedFile = $request->file('upload');
            $ext = $uploadedFile->getClientOriginalExtension();
            $size = $uploadedFile->getSize() / 1000;

            if (!in_array(strtolower($ext), $allowedExtensions) || $size > $maxSize) {
                $message = 'Tập tin không hợp lệ. Vui lòng tải lên tệp JPG, JPEG, PNG hoặc GIF có kích thước không quá 2MB';
            }

            if (!$message) {
                $currentDate = date('Y-m-d');
                $storagePath = storage_path('app/public/posts/images/' . $currentDate);

                if (!file_exists($storagePath)) {
                    mkdir($storagePath, 0777, true);
                }

                $filename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME) . '_' . uniqid() . '.' . $ext;

                $uploadedFile->move($storagePath, $filename);

                $url = asset("storage/posts/images/$currentDate/$filename");
                $message = "Ảnh của bạn đã được tải lên thành công";

                return "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$message')</script>";
            }
        } else {
            $message = 'Không có tệp được chọn';
        }

        return "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, null, '$message')</script>";
    }


}

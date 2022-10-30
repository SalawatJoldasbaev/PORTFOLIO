<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Src\Response;
use Illuminate\Http\Request;
use App\Http\Requests\Blogs\CreateRequest;
use App\Http\Requests\Blogs\UpdateRequest;

class BlogsController extends Controller
{
    public function CreateBlog(CreateRequest $request)
    {
        Blog::create([
            'title' => $request->title,
            'preview_image' => $request->preview_image,
            'content' => $request->content,
        ]);
        return Response::success();
    }

    public function UpdateBlog(UpdateRequest $request, Blog $blog)
    {
        $blog->update([
            'title' => $request->title,
            'preview_image' => $request->preview_image,
            'content' => $request->content,
        ]);
        return Response::success();
    }

    public function DeleteBlog(Request $request, Blog $blog)
    {
        $blog->delete();
        return Response::success();
    }

    public function ShowAllBlogs(Request $request)
    {
        $blogs = Blog::orderBy('id', 'desc')->paginate($request->per_page ?? 50);
        $data = [
            'last_page' => $blogs->lastPage(),
            'per_page' => $blogs->perPage(),
            'data' => []
        ];
        foreach ($blogs as $blog) {
            $data['data'][] = [
                'id' => $blog->id,
                'title' => $blog->title,
                'content' => $blog->content,
                'preview_image' => $blog->preview_image,
                'created_at' => $blog->created_at->format('Y-m-d H:i:s'),
            ];
        }
        return Response::success(payload: $data);
    }
}

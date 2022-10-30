<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Src\Response;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Comments\CreateRequest;

class CommentsController extends Controller
{
    public function CreateComment(CreateRequest $request)
    {
        Comment::create([
            'blog_id' => $request->blog_id,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'comment' => $request->comment,
        ]);
        $blog = Blog::find($request->blog_id);
        $message = Http::post("https://api.telegram.org/bot" . env("BOT_TOKEN") . "/sendMessage", [
            'chat_id' => env("ADMIN_ID"),
            'parse_mode' => 'html',
            'text' => "NEW COMMENT\n\nBlog: " . strip_tags($blog->title) . "\nName: " . strip_tags($request->user_name) . "\nEmail: " . strip_tags($request->email) . "\nComment: " . strip_tags($request->comment),
        ])->json();
        return Response::success();
    }

    public function DeleteComment(Comment $comment)
    {
        $comment->delete();
        return Response::success();
    }

    public function ShowCommentsWithBlog(Blog $blog)
    {
        $data = [];
        foreach ($blog->comments as $comment) {
            $data[] = [
                'id' => $comment->id,
                'comment' => $comment->comment,
                'user_name' => $comment->user_name,
                'email' => $comment->email,
                'created_at' => $comment->created_at->format('Y-m-d H:i:s')
            ];
        }
        return Response::success(payload: $data);
    }
}

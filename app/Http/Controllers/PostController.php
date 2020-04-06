<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(10);
        return view('welcome', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::with(['comments', 'comments.child'])->where('slug', $slug)->first();
        return view('show', compact('post'));
    }

    public function comment(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'comment' => 'required'
        ]);

        Comment::create([
            'post_id' => $request->id,
            'parent_id' => $request->parent_id != '' ? $request->parent_id:NULL,
            'username' => $request->username,
            'comment' => $request->comment
        ]);
        return redirect()->back()->with(['success' => 'Komentar Ditambahkan']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){

        $comment = Comment::create([
           'user_id' => auth()->user()->id,
           'post_id' => $request->post_id,
           'body' => $request->body,
        ]);
        return redirect()->back();

//       $post = Post::find($request->post_id);
//       $comment = $post->comments()->create([
//            'user_id' => 1,
//            'body' => $request->body
//        ]);
//       dd($comment);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostApiResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostApiController extends Controller
{

    public function index()
    {
//        return Post::limit(5)->get();
        return PostApiResource::collection(Post::all());
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')){
            $path = $request->file('image')->store('postImages');
        }

        $post = Post::create([
            'user_id' => 1,
            'category_id' =>$request->category_id,
            'title'=>$request->title,
            'short_content'=>$request->short_content,
            'content'=>$request->content,
            'image'=>$path ?? null,
        ]);

        if (isset($request->tags))
        {
            foreach ($request->tags as $tag){
                $post->tags()->attach($tag);
            }
        }

        return redirect(['success'=>'Post successfully created']);
    }

    public function show(Post $post)
    {
       return new PostApiResource($post);
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect(['success'=>'Post successfully deleted']);
    }
}

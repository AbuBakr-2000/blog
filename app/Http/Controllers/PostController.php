<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Jobs\ChangePost;
use App\Mail\PostHasBeenCreated;
use App\Models\Category;
use App\Models\Post;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\PostHasBeenDeleted;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    public function index()
    {
//        Cache::pull('posts');
//        =============== Cache ===================

        $posts = Cache::remember('posts', now()->addSeconds(30), function (){
           return Post::latest()->paginate(12);
        });
        return view('posts.index',['posts'=>$posts]);
    }

    public function create()
    {
        Gate::authorize('create-post', Role::find(2));

        return view('posts.create')
            ->with([
                'categories'=> Category::all(),
                'tags'=> Tag::all()
            ]);
    }

    public function store(StoreRequest $request)
    {
        Gate::authorize('create-post', Role::find(2));

        if ($request->hasFile('image')){
            //        $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->store('postImages');
        }

        $post = Post::create([
            'user_id' => auth()->user()->id,
            'category_id' =>$request->category_id,
            'title'=>$request->title,
            'short_content'=>$request->short_content,
            'content' =>$request->content,
            'image'=>$path ?? null,
        ]);

        if (isset($request->tags))
        {
            foreach ($request->tags as $tag){
                $post->tags()->attach($tag);
            }
        }
//=================== Event =========================
        PostCreated::dispatch($post);

// ======================= Job (queue) ==================
        ChangePost::dispatch($post);

//====================== Mail (php artisan queue:work --queue=sendingEmails) ========================
        Mail::to($request->user())->queue((new PostHasBeenCreated($post))->onQueue('sendingEmails'));

//========================= Notification ========================
        Notification::send(auth()->user(), new \App\Notifications\PostCreated($post));

        return redirect()->route('posts.index')->with('status','Post successfully created!');
    }


    public function show(Post $post)
    {
        return view('posts.show',[
            'post'=>$post,
            'recentPost'=> Post::latest()->get()->except($post->id)->take(5),
            'tags' => Tag::all(),
            'categories' => Category::all(),
        ]);
    }

    public function edit(Post $post)
    {
        Gate::authorize('update', $post);

        return view('posts.edit',['post'=>$post]);
    }

    public function update(UpdateRequest $request, Post $post)
    {
        Gate::authorize('update', $post);

        if ($request->hasFile('image')){
            if (isset($post->image)){
                Storage::delete($post->image);
            }

            $path = $request->file('image')->store('postImages');
        }

        $post->update(attributes: array(
            'title'=>$request->title,
            'short_content'=>$request->short_content,
            'content'=> $request->content,
            'image'=>$path ?? $post->image,
        ));
        return redirect()->route('posts.show',$post->id);
    }

    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        if (isset($post->image)){
            Storage::delete($post->image);
        }
        $post->delete();

//===================== Delete Notify ===================
//        Notification::send(auth()->user(), new PostHasBeenDeleted($post));

        return redirect()->route('posts.index');
    }
}

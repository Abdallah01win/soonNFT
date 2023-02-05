<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Inertia\Inertia;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::join('users', 'users.id', '=', 'posts.userId')
            ->where('status', 1)
            ->select('posts.*', 'users.name', 'users.image_url')
            ->get();
        return Inertia::render('Blog', ['posts' => $posts]);
    }
    public function count()
    {
        return Post::count();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::id();
        $postDesc = $request->get('description');
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,webp|max:2048',
            'category' => 'required',
            'body' => 'required',
        ]);

        $image_path = $request->file('image')->store('posts', 'public');
        $post = Post::create([
            'title' => $request->get('title'),
            'image' => asset('storage/'.$image_path),
            'category' => $request->get('category'),
            'body' => $request->get('body'),
            'description' => $postDesc,
            'userId' => $user_id,
        ]);
        sleep(1);
        return Redirect::route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $postId = $request->get('id');
        $post = Post::join('users', 'users.id', '=', 'posts.userId')
            ->where('posts.id', $postId)->limit(1)
            ->select('posts.*', 'users.name', 'users.image_url')
            ->get();

        $comments = Comment::join('users', 'users.id', '=', 'comments.user_id')
            ->where('post_id', $postId)
            ->where('comments.status', 1)->limit(10)
            ->select('comments.*', 'users.name', 'users.image_url')
            ->get();

        $post_category = $post[0]['category'];
        $similar_posts = Post::where('id', '!=', $postId)
            ->where('category', $post_category)->limit(4)
            ->select('id', 'title', 'category', 'image')
            ->get();
        // make them an inertia link

        // add comments section, table, controller and form on post page

        return Inertia::render('Post', [
            'post' => $post[0],
            'similar' => $similar_posts,
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}

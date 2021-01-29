<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['comments.user', 'user'])->orderBy('created_at', 'desc')->get();

        return response()->json([
            "success" => true,
            "posts" => $posts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $post = new Post();
        $post->body = $request->body;

        if (auth()->user()->posts()->save($post)) {
            return response()->json([
                'success' => true,
                'post' => $post->load('user')
            ]);
        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'Error while adding the post.'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json([
            'success' => true,
            'post' => $post
        ], 400);
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

        if (auth()->user()->cannot('delete', $post)) {
            abort(403);
        }

        $post->delete();

        return response()->json([
            'success' => true,
            'comment' => $post
        ]); 
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request, $id)
    {
        $post = Post::find($id);

        $this->validate($request, [
            'body' => 'required'
        ]);

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = auth()->id();

        if ($post->comments()->save($comment)) {
            return response()->json([
                'success' => true,
                'comment' => $comment->load('user')
            ]);
        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'Error while adding the comment.'
            ], 500);
        }
    }
}

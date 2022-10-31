<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\likes;
use App\Models\dislikes;
use Illuminate\Support\Facades\Auth;
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
        //
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
        Post::create([

            'user_id'=> Auth::user()->id,
            'likes' => 0,
            'desliks' => 0,
            'desc' => $request ->desc

        ]);

        flash()->addSuccess('Post Published Successfuly');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
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



    public function likes(Request $request)
    {
        $post_id = $request->postId;
        $user_id = Auth::user()->id;
        $post = Post::findOrFail($request->postId);

        $post_like = likes::where(['user_id'=> $user_id,'post_id'=>$post_id])->first();

        if(likes::where(['user_id'=> $user_id,'post_id'=>$post_id])->exists() ){

            $post_like->delete();
            $post->decrement('likes');
            $post->save();

        }
        else{
            $post_dislike = dislikes::where(['user_id'=> $user_id,'post_id'=>$post_id])->first();

            if(dislikes::where(['user_id'=> $user_id,'post_id'=>$post_id])->exists() ){

                $post_dislike->delete();
                $post->decrement('desliks');
                $post->save();

            }
            $post->increment('likes');
            $post->save();
            likes::create([
                'user_id'=> $user_id,
                'post_id'=> $post_id
            ]);
        }
        return response()->json(['likes'=>$post->likes,'dislikes'=>$post->desliks]);
    }


    public function dislikes(Request $request)
    {
        $post_id = $request->postId;
        $user_id = Auth::user()->id;
        $post = Post::findOrFail($request->postId);

        $post_dislike = dislikes::where(['user_id'=> $user_id,'post_id'=>$post_id])->first();

        if(dislikes::where(['user_id'=> $user_id,'post_id'=>$post_id])->exists() ){

            $post_dislike->delete();
            $post->decrement('desliks');
            $post->save();

        }
        else{
            $post_like = likes::where(['user_id'=> $user_id,'post_id'=>$post_id])->first();
            if(likes::where(['user_id'=> $user_id,'post_id'=>$post_id])->exists() ){

                $post_like->delete();
                $post->decrement('likes');
                $post->save();

            }
            $post->increment('desliks');
            $post->save();
            dislikes::create([
                'user_id'=> $user_id,
                'post_id'=> $post_id
            ]);


        }
        return response()->json(['likes'=>$post->likes,'dislikes'=>$post->desliks]);
    }

}

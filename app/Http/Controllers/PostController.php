<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['belongsToUser'])->get();
        return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                Storage::disk('public')->putFileAs("img/posts/",$request->file("imgPost"), $request->file("imgPost")->getClientOriginalName() );
                $url = Storage::disk('public')->url("img/posts/".$request->file("imgPost")->getClientOriginalName());
                    $post = new Post();
                    $post->title = $request->title;
                    $post->description = $request->description;
                    $post->status = $request->status;
                    $post->user_id = Auth::user()->id;
                    $post->url_img = asset($url);
                    $post->save();
            });
        } catch (\Throwable $th) {
            throw $th;
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}

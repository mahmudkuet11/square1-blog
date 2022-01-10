<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'published_at' => $request->published_at,
        ]);

        return redirect()->route('dashboard')->with('status', __('Post is saved successfully!'));
    }
}

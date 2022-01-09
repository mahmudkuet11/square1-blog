<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $cacheKey = "posts:" . $request->get('page', 1);
        $posts = Cache::tags(['posts'])->remember($cacheKey, now()->addHour(), function () {
            return Post::with('user')->latest('id')->paginate(10);
        });

        return view('home', compact('posts'));
    }
}

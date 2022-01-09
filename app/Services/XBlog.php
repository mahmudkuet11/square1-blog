<?php

namespace App\Services;

use App\Contracts\BlogPlatform;
use Illuminate\Support\Facades\Http;

class XBlog implements BlogPlatform
{
    public function fetchNewPosts()
    {
        $response = Http::acceptJson()->get("https://sq1-api-test.herokuapp.com/posts");

        return $response->successful() ? $response->json() : ['data' => []];
    }
}

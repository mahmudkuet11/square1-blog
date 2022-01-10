<?php

namespace App\Services;

use App\Contracts\BlogPlatform;
use App\Models\Post;
use App\Models\User;

class BlogService
{
    public static function importNewPosts(BlogPlatform $blogPlatform)
    {
        $posts = $blogPlatform->fetchNewPosts();
        $admin = User::where('email', 'admin@example.com')->first();

        foreach ($posts['data'] as $post) {
            Post::create([
                'user_id' => $admin->id,
                'title' => $post['title'],
                'description' => $post['description'],
                'published_at' => $post['publication_date'],
            ]);
        }
    }
}

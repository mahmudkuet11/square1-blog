<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_shows_all_posts()
    {
        $posts = Post::factory()->count(20)->create()->sortByDesc('id')->values();

        $response = $this->get('/');
        $response->assertSeeTextInOrder([
            $posts->get(0)->title, $posts->get(0)->user->name, $posts->get(0)->published_at->toDayDateTimeString(), $posts->get(0)->description,
            $posts->get(1)->title, $posts->get(1)->user->name, $posts->get(1)->published_at->toDayDateTimeString(), $posts->get(1)->description,
        ]);
    }

    /**
     * @test
     */
    public function it_shows_posts_with_pagination()
    {
        $posts = Post::factory()->count(20)->create()->sortByDesc('id')->values();

        $response = $this->get('/?page=1');
        $response->assertSeeTextInOrder([
            $posts->get(0)->title, $posts->get(0)->user->name, $posts->get(0)->published_at->toDayDateTimeString(), $posts->get(0)->description,
        ]);

        $response = $this->get('/?page=2');
        $response->assertSeeTextInOrder([
            $posts->get(10)->title, $posts->get(10)->user->name, $posts->get(10)->published_at->toDayDateTimeString(), $posts->get(10)->description,
        ]);
    }
}

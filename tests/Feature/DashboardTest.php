<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_shows_all_posts_published_by_authenticated_user()
    {
        $john = $this->login();
        $jane = User::factory()->create();

        $johnPosts = Post::factory()->count(5)->create(['user_id' => $john->id]);
        $janePosts = Post::factory()->count(5)->create(['user_id' => $jane->id]);

        $response = $this->get('/dashboard');
        $response->assertSeeTextInOrder([
            $johnPosts->get(1)->title, $johnPosts->get(1)->published_at->toDayDateTimeString(),
            $johnPosts->get(0)->title, $johnPosts->get(0)->published_at->toDayDateTimeString(),
        ]);

        $response->assertDontSeeText($janePosts->get(0)->title);
    }

    /**
     * @test
     */
    public function posts_can_be_sorted_by_publication_date()
    {
        $user = $this->login();

        // Sort ASC
        $posts = Post::factory()->count(5)->create(['user_id' => $user->id])->sortBy('published_at')->values();
        $response = $this->get('/dashboard?sort=published_at&sort-dir=asc');
        $response->assertSeeTextInOrder([
            $posts->get(0)->title,
            $posts->get(1)->title,
        ]);

        // Sort DESC
        $posts = $posts->sortByDesc('published_at')->values();
        $response = $this->get('/dashboard?sort=published_at&sort-dir=desc');
        $response->assertSeeTextInOrder([
            $posts->get(0)->title,
            $posts->get(1)->title,
        ]);
    }

    /**
     * @test
     */
    public function it_shows_posts_with_pagination()
    {
        $user = $this->login();
        $posts = Post::factory()->count(20)->create(['user_id' => $user->id])->sortByDesc('id')->values();

        $response = $this->get('/dashboard?page=2');
        // Posts from 2nd page will be shown
        $response->assertSeeTextInOrder([
            $posts->get(10)->title,
            $posts->get(11)->title,
        ]);

        // Posts from 1st page won't be shown
        $response->assertDontSeeText($posts->get(0)->title);
    }
}

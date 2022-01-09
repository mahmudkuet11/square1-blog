<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\BlogService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Stub\BlogPlatformStub;
use Tests\TestCase;

class BlogServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_imports_new_posts_from_third_party_platform()
    {
        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
        ]);

        BlogService::importNewPosts(app(BlogPlatformStub::class));

        $this->assertDatabaseHas('posts', [
            'title' => 'Title 1',
            'description' => 'Description 1',
            'published_at' => '2022-01-08 10:09:38',
            'user_id' => $admin->id,
        ]);
    }
}

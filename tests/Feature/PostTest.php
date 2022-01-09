<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function it_shows_form_to_create_new_post()
    {
        $this->login();

        $this->get('/posts/create')->assertSeeTextInOrder([
            'Title', 'Description', 'Publication Date'
        ]);
    }

    /**
     * @test
     */
    public function it_stores_post_in_database_after_submit()
    {
        $this->login();

        $title = $this->faker->sentence();
        $description = $this->faker->paragraph();
        $published_at = now();
        $this->post('/posts', [
            'title' => $title,
            'description' => $description,
            'published_at' => $published_at,
        ])->assertRedirect('/dashboard');

        $this->assertDatabaseHas('posts', [
            'title' => $title,
            'description' => $description,
            'published_at' => $published_at,
        ]);
    }

    /**
     * @test
     */
    public function it_shows_validation_error_for_invalid_data()
    {
        $this->login();

        $this->post('/posts', [])->assertSessionHasErrors(['title', 'description', 'published_at']);
    }
}

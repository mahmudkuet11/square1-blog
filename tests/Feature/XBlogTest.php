<?php

namespace Tests\Feature;

use App\Services\XBlog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class XBlogTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_data_in_correct_format_while_fetching_new_posts()
    {
        $response = [
            'data' => [
                ['title' => 'title 1', 'description' => 'desc 1', 'publication_date' => '2022-01-08 11:23:48'],
                ['title' => 'title 2', 'description' => 'desc 2', 'publication_date' => '2022-01-08 11:23:48'],
            ]
        ];
        $sequence = Http::sequence()
            ->push($response, 200)
            ->pushStatus(500);
        Http::fake([
            'sq1-api-test.herokuapp.com/*' => $sequence
        ]);

        $response = app(XBlog::class)->fetchNewPosts();
        $this->assertJson(json_encode($response));

        // It handles error when 3rd party blog is unable to handle the request
        $response = app(XBlog::class)->fetchNewPosts();
        $this->assertJson(json_encode(['data' => []]));
    }
}

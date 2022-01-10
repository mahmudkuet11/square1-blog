<?php

namespace Tests\Browser;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomePageTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_shows_latest_posts_after_new_post_is_created()
    {
        $user = User::factory()->create();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/posts/create')
                ->type('title', 'Test Title')
                ->type('description', 'Test Description')
                ->script('document.querySelector("#published_at").value="2022-01-10T01:30"');
            $browser->press('Submit')
                ->visit('/')
                ->assertSee('Test Title')
                ->assertSee('Test Description');
        });
    }

    /**
     * @test
     */
    public function it_shows_posts_with_pagination()
    {
        $posts = Post::factory()->count(30)->create()->sortByDesc('id')->values();

        $this->browse(function (Browser $browser) use ($posts) {
            $browser->visit('/')
                ->script('document.querySelector("li.page-item a").click()');
            $browser->assertSee($posts->get(10)->title);
        });
    }

    /**
     * @test
     */
    public function it_shows_menu_items_properly()
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/')
                ->assertSee("Login")
                ->assertSee("Register")
                ->click('@login_menu_link')
                ->assertPathIs('/login')

                ->visit('/')
                ->click('@register_menu_link')
                ->assertPathIs('/register')

                ->loginAs($user)
                ->visit('/')
                ->click('@dashboard_menu_link')
                ->assertPathIs('/dashboard');
        });
    }
}

<?php

namespace Tests\Browser;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DashboardTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function posts_are_shown_by_pagination()
    {
        $user = User::factory()->create();
        $posts = Post::factory()->count(30)->create(['user_id' => $user->id])->sortByDesc('id')->values();

        $this->browse(function (Browser $browser) use ($user, $posts) {
            $browser->loginAs($user)
                ->visit('/dashboard')
                ->click('li.page-item a')
                ->assertSee($posts->get(10)->title);
        });
    }

    /**
     * @test
     */
    public function posts_can_be_sorted_by_publication_date()
    {
        $user = User::factory()->create();
        $posts = Post::factory()->count(30)->create(['user_id' => $user->id])->sortBy('published_at')->values();

        $this->browse(function (Browser $browser) use ($user, $posts) {
            $browser->loginAs($user)
                ->visit('/dashboard')
                ->click('#sort-col-published_at a')
                ->assertSee($posts->get(0)->title);

            $posts = $posts->sortByDesc('published_at')->values();
            $browser->click('#sort-col-published_at a')
                ->assertSee($posts->get(0)->title);
        });
    }

    /**
     * @test
     */
    public function it_redirects_user_to_post_creation_form_when_create_new_post_button_is_clicked()
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/dashboard')
                ->click('@create_new_post_btn')
                ->assertPathIs('/posts/create');
        });
    }
}

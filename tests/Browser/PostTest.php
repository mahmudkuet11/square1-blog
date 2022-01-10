<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PostTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function user_can_create_new_post()
    {
        $user = User::factory()->create();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/posts/create')
                ->type('title', 'Test Title')
                ->type('description', 'Test Description')
                ->script('document.querySelector("#published_at").value="2022-01-10T01:30"');
            $browser->press('Submit')
                ->assertPathIs('/dashboard')
                ->assertSee('Post is saved successfully!')
                ->assertSee('Test Title');
        });
    }

    /**
     * @test
     */
    public function it_redirects_user_to_dashboard_when_back_button_is_clicked()
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/posts/create')
                ->click('@back_btn')
                ->assertPathIs('/dashboard');
        });
    }
}

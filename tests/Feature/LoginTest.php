<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_shows_the_login_form()
    {
        $response = $this->get('/login');

        $response->assertOk()
            ->assertSeeText("E-Mail Address")
            ->assertSeeText("Password");
    }

    /**
     * @test
     */
    public function it_logs_in_user_for_valid_credentials()
    {
        $user = User::factory(['password' => bcrypt('password')])->create();

        $response = $this->post("/login", [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function it_throws_error_for_invalid_credentials()
    {
        $user = User::factory(['password' => bcrypt('password')])->create();

        $response = $this->post("/login", [
            'email' => $user->email,
            'password' => 'wrong_password',
        ]);
        $response->assertSessionHasErrors(['email']);

        $response = $this->post("/login", [
            'email' => "invalid_email",
            'password' => 'password',
        ]);
        $response->assertSessionHasErrors(['email']);
    }

    /**
     * @test
     */
    public function only_guest_can_access_the_login_page()
    {
        $this->login();
        $this->get('/login')->assertRedirect('/dashboard');
    }
}

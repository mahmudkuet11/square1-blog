<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_shows_the_registration_form()
    {
        $response = $this->get('/register');

        $response->assertOk()
            ->assertSeeText("Name")
            ->assertSeeText("E-Mail Address")
            ->assertSeeText("Password")
            ->assertSeeText("Confirm Password");
    }

    /**
     * @test
     */
    public function it_stores_data_after_registration()
    {
        $response = $this->post("/register", [
            'name' => "John Doe",
            'email' => 'john@example.com',
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com'
        ]);
    }

    /**
     * @test
     */
    public function it_throws_error_for_invalid_data()
    {
        $response = $this->post("/register", [
            'name' => "",
            'email' => 'invalid_email',
            'password' => 'unsafe',
            'password_confirmation' => 'unmatched_password'
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    /**
     * @test
     */
    public function it_ensures_that_the_email_address_is_unique()
    {
        $existingUser = User::factory([
            'email' => 'john@example.com',
        ])->create();

        $response = $this->post("/register", [
            'name' => "John Doe",
            'email' => $existingUser->email,
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ]);

        $response->assertSessionHasErrors('email');
    }
}

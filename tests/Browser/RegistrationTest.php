<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegistrationTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    /**
     * @test
     */
    public function user_can_register()
    {
        $this->browse(function(Browser $browser){
            $browser->visit('/register')
                ->type('name', 'John Doe')
                ->type('email', 'john@example.com')
                ->type('password', 'password')
                ->type('password_confirmation', 'password')
                ->press('Register')
                ->assertPathIs('/dashboard');
        });
    }
}

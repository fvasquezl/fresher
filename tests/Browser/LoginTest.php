<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     * @throws \Throwable
     * @test
     */
    public function user_can_sign_in()
    {
	$user = Factory(User::class)
		->create(['email'=>'fvasquez@local.com']);

        $this->browse(function (Browser $browser) use ($user){
            $browser->visit('/login')
                ->type('#email',$user->email)
                ->type('#password','password')
                ->press('Login')
                ->assertPathIs('/home');
        });
    }

}

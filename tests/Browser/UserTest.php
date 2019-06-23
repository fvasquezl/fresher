<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     * @throws \Throwable
     * @test
     */
    public function admin_can_create_user()
    {
        $user = factory(User::class)->raw();
        $this->browse(function (Browser $browser) use($user){
            $browser->loginAs($this->adminUser())
                ->visit('/users')
                ->press('Create User')
                ->waitFor('modal',function($modal) use($user){
                    $modal->type('#name',$user->name)
                        ->type('#email',$user->email)
                        ->password('#password',$user->password);
                });
            $this->assertDatabaseHas('users',[
               'name' => $user->email
            ]);
        });
    }
}

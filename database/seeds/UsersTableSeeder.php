<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=factory(User::class)->create([
            'name'=>'Faustino Vasquez',
            'email' => 'fvasquez@local.com',
        ]);
        $admin->giveRoles('admin');
        $admin=factory(User::class)->create([
            'name'=>'Sebastian Vasquez',
            'email' => 'svasquez@local.com',
        ]);
        $admin->giveRoles('employee');
        factory(User::class,400)->create()->each(
            function($user){
                $roles = Role::all()->random(mt_rand(1,3))->pluck('id');
                $user->roles()->attach($roles);
            }
        );
    }
}

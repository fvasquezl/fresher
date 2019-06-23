<?php
/**
 * Created by PhpStorm.
 * User: fvasquez
 * Date: 6/22/19
 * Time: 9:33 PM
 */

namespace Tests;


use App\Role;
use App\User;

trait TestHelperTrait
{
    protected $adminUser,$employeeUser;
    public function adminUser()
    {
        if ($this->adminUser){
            return $this->adminUser;
        }
        factory(Role::class)->create(['name'=>'admin']);
        $this->adminUser = factory(User::class)->create();
        $this->adminUser->giveRoles('admin');
        return $this->adminUser;
    }
    public function employeeUser()
    {
        if ($this->employeeUser){
            return $this->employeeUser;
        }
        factory(Role::class)->create(['name'=>'it']);
        $this->employeeUser = factory(User::class)->create();
        $this->employeeUser->giveRoles('it');
        return $this->employeeUser;
    }


}
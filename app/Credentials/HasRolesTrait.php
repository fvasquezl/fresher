<?php
/**
 * Created by PhpStorm.
 * User: fvasquez
 * Date: 6/22/19
 * Time: 9:48 PM
 */

namespace App\Credentials;


use App\Role;
use Illuminate\Support\Arr;

trait HasRolesTrait
{
    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }
        return false;
    }
    public function giveRoles(...$roles)
    {
        $roles = $this->getValidRoles(Arr::flatten($roles));
        if ($roles === null) {
            return false;
        }
        $this->roles()->saveMany($roles);
        return true;
    }
    public function updateRoles(...$roles)
    {
        $this->roles()->detach();
        return $this->giveRoles($roles);
    }
    public function getRoles(){
        return  $this->roles()->pluck('name','id');
    }
    protected function getValidRoles(array $roles)
    {
        if($this->rolesListIncludesAdmin($roles)){
            return Role::where('name', 'admin')->get();
        }
        return Role::whereIn('name', $roles)->get();
    }
    protected function rolesListIncludesAdmin($roles)
    {
        return in_array('admin', $roles);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }
}
<?php

namespace App\Http\Requests;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:60', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'roles'=> ['required']
        ];
    }
    public function createUser()
    {
        $user = new User;
        $user->fill([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);
        $user->save();
        if($this->roles !== null){
            $user->giveRoles($this->roles);
        }
    }
}


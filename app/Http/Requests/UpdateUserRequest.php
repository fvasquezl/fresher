<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateUserRequest extends FormRequest
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
            'email' => [
                'required',
                'string',
                'email',
                'max:60',
                Rule::unique('users')->ignore($this->user)
            ],
            'password' => ['sometimes','string', 'min:8'],
            'roles'=> [Rule::exists('roles', 'name'),]
        ];
    }
    public function updateUser($user)
    {
        $user->fill([
            'name' => $this->name,
            'email' => $this->email,
        ]);
        if ($this->password != null) {
            $user->password = bcrypt($this->password);
        }
        $user->save();
        if($this->roles !== null){
            $user->giveRoles($this->roles);
        }
    }
}


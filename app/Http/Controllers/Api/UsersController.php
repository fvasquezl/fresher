<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserCollection
     */
    public function index()
    {
        return new UserCollection(User::latest()->paginate(8));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return array
     */
    public function store(StoreUserRequest $request)
    {
        $request->createUser();
        return ['success'=> 'The user has been successfully created'];
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return array
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $request->updateUser($user);
        return ['success'=> 'The user has been successfully updated'];
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return array
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();
        return ['success'=> 'The user has been successfully delete'];
    }
}
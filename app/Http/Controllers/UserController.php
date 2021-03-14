<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;


class UserController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:user-list');
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['delete']]);
    }

    public function index()
    {
        $user = User::get();

        return response()->json(['user' => $user]);
    }

    public function store(StoreUserRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $name = $request->input('name');

        $user = User::createFromValues($name, $email, $password);
        $user->roles()->sync($request->input('roles', []));

        return (new UserResource($user));
    }

    public function show($id)
    {
        $user = User::find($id);

        if(!$user) {
            return response()->json(['message' => 'user not found.']);
        }

        return new UserResource($user->load(['roles']));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return new UserResource($user->load(['roles']));
    }

    public function delete($id)
    {
        DB::table("users")->where('id',$id)->delete();

        return response()->json(['message' => 'User Deleted.']);
    }
}
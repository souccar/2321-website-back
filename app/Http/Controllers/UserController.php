<?php

namespace App\Http\Controllers;

use App\Helpers\AhcResponse;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function GetAll($count){
        $users = User::Paginate(
            $perPage = $count
        );

        if ($users) {
            if ($users->count() == 0)
                return AhcResponse::sendResponse();
            return AhcResponse::sendResponse($users);
        } else {
            return AhcResponse::sendResponse([],false, ['Error']);
        }
    }

    public function getById($id)
    {
        $user = User::find($id);

        if ($user == null)
            return AhcResponse::sendResponse([], false, ['User With Id : ' . $id . ' Not Found']);
        return AhcResponse::sendResponse($user);
    }

    public function register(UserRequest $request){

        $request->validated();

        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return AhcResponse::sendResponse($data);
    }

    public function edit(EditUserRequest $request, $id){

        $request->validated();
        $user = User::find($id);
        
        $user->update([
            'name'=> $request->name != null ? $request->name : $user->name,
            'email'=> $request->email != null ? $request->email : $user->email,
            'password'=> $request->password != null ? Hash::make($request->password) : $user->password
        ]);

        $user->save();

        return AhcResponse::sendResponse($user);
    }

    public function destroy($id)
    {
        $original = User::find($id);
        $isDeleted = $original->delete();

        if ($isDeleted) {
            return AhcResponse::sendResponse(['Delete Successfuly']);
        } else {
            return AhcResponse::sendResponse([], false, ['DeleteError']);
        }

    }
}

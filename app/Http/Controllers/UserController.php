<?php

namespace App\Http\Controllers;

use App\Helpers\AhcResponse;
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

    public function edit(UserRequest $request, $id){

        $request->validated();
        $user = User::find($id);

        $user->update([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password)
        ]);

        $user->save();

        return AhcResponse::sendResponse($user);
    }

    public function destroy($id)
    {
        $original = User::find($id);
        $isDeleted = $original->delete();

        if ($isDeleted) {
            return response()->json([
                'success' => true,
                'message' => 'Delete Successfuly'
            ]);
        } else {
            return AhcResponse::sendResponse([], false, ['DeleteError']);
        }

    }
}

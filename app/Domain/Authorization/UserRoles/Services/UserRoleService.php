<?php

namespace App\Domain\Authorization\UserRoles\Services;
use App\Domain\Authorization\UserRoles\Models\UserRole;


class UserRoleService implements IUserRoleService
{
    public function GetAll($count){
        $data = UserRole::Paginate(
            $perPage = $count
        );
        return $data; 
    }
    public function GetById($id){
        return UserRole::find($id);
    }

    public function Create($entity){
        $result = UserRole::create($entity);
        return $result;
    }
    public function Update($entity,$id){
        $original = UserRole::find($id);
        $original->update($entity);
        $original->save();
        return $original;
    }
    public function Delete($id){
        $original = UserRole::find($id);
        return $original->delete();
    }
}

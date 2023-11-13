<?php

namespace App\Domain\Authorization\RolePermissions\Services;
use App\Domain\Authorization\RolePermissions\Models\RolePermission;


class RolePermissionService implements IRolePermissionService
{
    public function GetAll($count){
        $data = RolePermission::Paginate(
            $perPage = $count
        );
        return $data; 
    }
    public function GetById($id){
        return RolePermission::find($id);
    }

    public function Create($entity){
        $result = RolePermission::create($entity);
        return $result;
    }
    public function Update($entity,$id){
        $original = RolePermission::find($id);
        $original->update($entity);
        $original->save();
        return $original;
    }
    public function Delete($id){
        $original = RolePermission::find($id);
        return $original->delete();
    }
}

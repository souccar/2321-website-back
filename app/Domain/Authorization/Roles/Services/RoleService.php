<?php

namespace App\Domain\Authorization\Roles\Services;
use App\Domain\Authorization\Roles\Models\Role;


class RoleService implements IRoleService
{
    public function GetAll($count){
        $data = Role::Paginate(
            $perPage = $count
        );
        return $data; 
    }
    public function GetById($id){
        return Role::find($id);
    }

    public function Create($entity){
        $result = Role::create($entity);
        return $result;
    }
    public function Update($entity,$id){
        $original = Role::find($id);
        $original->update($entity);
        $original->save();
        return $original;
    }
    public function Delete($id){
        $original = Role::find($id);
        return $original->delete();
    }
}

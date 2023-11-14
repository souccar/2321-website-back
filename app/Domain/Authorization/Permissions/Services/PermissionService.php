<?php

namespace App\Domain\Authorization\Permission\Services;
use App\Domain\Authorization\Permissions\Models\Permission;
use App\Domain\Authorization\Permissions\Services\IPermissionService;


class PermissionService implements IPermissionService
{
    public function GetAll($count){
        $data = Permission::Paginate(
            $perPage = $count
        );
        return $data; 
    }
    public function GetById($id){
        return Permission::find($id);
    }

    public function Create($entity){
        $result = Permission::create($entity);
        return $result;
    }
    public function Update($entity,$id){
        $original = Permission::find($id);
        $original->update($entity);
        $original->save();
        return $original;
    }
    public function Delete($id){
        $original = Permission::find($id);
        return $original->delete();
    }
}

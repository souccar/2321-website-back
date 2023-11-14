<?php

namespace App\Domain\Authorization\RolePermissions\Services;


interface IRolePermissionService
{
    function GetAll($count);
    function GetById($id);
    function Create($entity);
    function Update($entity,$id);
    function Delete($id);
}

<?php

namespace App\Domain\Authorization\UserRoles\Services;


interface IUserRoleService
{
    function GetAll($count);
    function GetById($id);
    function Create($entity);
    function Update($entity,$id);
    function Delete($id);
}

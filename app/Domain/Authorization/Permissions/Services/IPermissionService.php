<?php

namespace App\Domain\Authorization\Permissions\Services;


interface IPermissionService
{
    function GetAll($count);
    function GetById($id);
    function Create($entity);
    function Update($entity,$id);
    function Delete($id);
}

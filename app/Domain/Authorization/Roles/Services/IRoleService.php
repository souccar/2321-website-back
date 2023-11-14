<?php

namespace App\Domain\Authorization\Roles\Services;


interface IRoleService
{
    function GetAll($count);
    function GetById($id);
    function Create($entity);
    function Update($entity,$id);
    function Delete($id);
}

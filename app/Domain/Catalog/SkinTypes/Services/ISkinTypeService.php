<?php

namespace App\Domain\Catalog\SkinTypes\Services;


interface ISkinTypeService
{
    function GetAll($count);
    function GetById($id);
    function Create($entity);
    function Update($entity,$id);
    function Delete($id);
}

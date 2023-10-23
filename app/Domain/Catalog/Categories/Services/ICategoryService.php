<?php

namespace App\Domain\Catalog\Categories\Services;


interface ICategoryService
{
    function GetAll($count);
    function GetById($id);
    function Create($entity);
    function Update($entity,$id);
    function Delete($id);
}

<?php

namespace App\Domain\Catalog\Brands\Services;


interface IBrandService
{
    function GetAll($count);
    function GetById($id);
    function Create($entity);
    function Update($entity,$id);
    function Delete($id);
}

<?php

namespace App\Domain\Catalog\Products\Services;


interface IProductService
{
    function GetAll($count);
    function GetById($id);
    function getByCategoryId($categoryId,$count);
    function getByBrandId($brandId,$count);
    function getBySkinTypeId($skinTypeId,$count);
    function Create($entity);
    function Update($entity,$id);
    function Delete($id);
}

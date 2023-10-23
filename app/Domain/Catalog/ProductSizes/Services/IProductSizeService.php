<?php

namespace App\Domain\Catalog\ProductSizes\Services;


interface IProductSizeService
{
    function GetAll();
    function GetById($id);
    function GetByProductId($productId);
    function Create($entity);
    function Update($entity,$id);
    function Delete($id);
}

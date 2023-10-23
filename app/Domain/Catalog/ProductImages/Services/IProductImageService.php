<?php

namespace App\Domain\Catalog\ProductImages\Services;


interface IProductImageService
{
    function GetAll();
    function GetById($id);
    function GetByProductId($productId);
    function Create($entity);
    function Update($entity,$id);
    function Delete($id);
}

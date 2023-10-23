<?php

namespace App\Domain\Catalog\Products\Services;

use App\Domain\Catalog\Products\Models\Product;
use App\Domain\Catalog\Products\Services\IProductService;

class ProductService implements IProductService
{
    public function GetAll($count)
    {
        return Product::with(['category' => function ($query) {
            $query->select('id', 'name');
        }])->with('brand')->with('skinType')->with('productImages')->with('productSizes')
        ->Paginate($perPage = $count);
    }
    public function GetById($id)
    {
        return Product::with(['category' => function ($query) {
            $query->select('id', 'name');
        }])->with('brand')->with('skinType')->with('productImages')->with('productSizes')->find($id);
    }

    function getByCategoryId($categoryId,$count)
    {
        return Product::where('categoryId','=',$categoryId)
        ->with(['category' => function ($query) {
            $query->select('id', 'name');
        }])->with('brand')->with('skinType')->with('productImages')->with('productSizes')
        ->Paginate($perPage = $count);
    }

    function getByBrandId($brandId,$count)
    {
        return Product::where('brandId','=',$brandId)
        ->with(['category' => function ($query) {
            $query->select('id', 'name');
        }])->with('brand')->with('skinType')->with('productImages')->with('productSizes')
        ->Paginate($perPage = $count);
    }

    function getBySkinTypeId($skinTypeId,$count){
        return Product::where('skinTypeId','=',$skinTypeId)
        ->with(['category' => function ($query) {
            $query->select('id', 'name');
        }])->with('brand')->with('skinType')->with('productImages')->with('productSizes')
        ->Paginate($perPage = $count);
    }

    public function Create($entity)
    {
        $result = Product::create($entity);
        return $this->GetById($result->id);
    }
    public function Update($entity, $id)
    {
        // $original = Product::find($id);
        $original = $this->GetById($id);
        $original->update($entity);
        $original->save();
        return $original;
    }
    public function Delete($id)
    {
        $original = Product::find($id);
        return $original->delete();
    }
}
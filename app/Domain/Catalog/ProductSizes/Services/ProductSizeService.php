<?php

namespace App\Domain\Catalog\ProductSizes\Services;

use App\Domain\Catalog\ProductSizes\Models\ProductSize;
use App\Domain\Catalog\ProductSizes\Services\IProductSizeService;

class ProductSizeService implements IProductSizeService
{
    public function GetAll(){
        return ProductSize::all();
    }
    public function GetById($id){
        return ProductSize::find($id)->get();
    }

    public function GetByProductId($productId){
        return ProductSize::where('productId','=',$productId)->get();
    }

    public function Create($entity){
        return ProductSize::create($entity);
    }
    public function Update($entity,$id){
        $original = ProductSize::find($id);
        $original->update($entity);
        $original->save();
        return $original;
    }
    public function Delete($id){
        $original = ProductSize::find($id);
        $original->delete();
    }
}

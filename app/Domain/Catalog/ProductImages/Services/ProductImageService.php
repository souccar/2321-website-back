<?php

namespace App\Domain\Catalog\ProductImages\Services;

use App\Domain\Catalog\ProductImages\Models\ProductImage;
use App\Domain\Catalog\ProductImages\Services\IProductImageService;
use File;


class ProductImageService implements IProductImageService
{
    public function GetAll(){
        return ProductImage::all();
    }
    public function GetById($id){
        return ProductImage::find($id)->get();
    }

    public function GetByProductId($productId)
    {
        return ProductImage::where('productId','=',$productId)->get();
    }

    public function Create($entity){
        return ProductImage::create($entity);
    }
    public function Update($entity,$id){
        $original = ProductImage::find($id);
        $original->update($entity);
        $original->save();
        return $original;
    }
    public function Delete($id){
        $original = ProductImage::find($id);
        $original->delete();
        File::delete(str_replace('\\', '/', public_path() . '/' . $original->imagePath));
    }
}

<?php

namespace App\Domain\Catalog\Brands\Services;

use App\Domain\Catalog\Brands\Models\Brand;
use App\Domain\Catalog\Brands\Services\IBrandService;


class BrandService implements IBrandService
{
    public function GetAll($count)
    {
        return Brand::Paginate(
            $perPage = $count
        );
    }
    public function GetById($id)
    {
        return Brand::find($id);
    }

    public function Create($entity)
    {
        return Brand::create($entity);
        
    }
    public function Update($entity, $id)
    {
        $original = $this->GetById($id);
        $original->update($entity);
        $original->save();
        return $original;
    }
    public function Delete($id)
    {
        $original = Brand::find($id);
        return $original->delete();
    }
}
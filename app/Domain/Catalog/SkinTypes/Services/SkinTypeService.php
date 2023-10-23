<?php

namespace App\Domain\Catalog\SkinTypes\Services;

use App\Domain\Catalog\SkinTypes\Models\SkinType;
use App\Domain\Catalog\SkinTypes\Services\ISkinTypeService;


class SkinTypeService implements ISkinTypeService
{
    public function GetAll($count)
    {
        return SkinType::Paginate(
            $perPage = $count
        );
    }
    public function GetById($id)
    {
        return SkinType::find($id);
    }

    public function Create($entity)
    {
        return SkinType::create($entity);
        
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
        $original = SkinType::find($id);
        return $original->delete();
    }
}
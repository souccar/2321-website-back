<?php

namespace App\Domain\Catalog\Categories\Services;


use App\Domain\Catalog\Categories\Models\Category;

class CategoryService implements ICategoryService
{
    public function GetAll($count){
        $data = Category::with('category')->Paginate(
            $perPage = $count
        ); 
        
        foreach ($data as $item){
            $item->append('imageBase64');
        }

        return $data; 
    }
    public function GetById($id){
        return Category::with('category')->find($id);
    }
    public function Create($entity){
        $result = Category::create($entity);
        return $this->GetById($result->id);
    }
    public function Update($entity,$id){
        $original = Category::find($id);
        $original->update($entity);
        $original->save();
        return $this->GetById($id);
    }
    public function Delete($id){
        $original = Category::find($id);
        return $original->delete();
    }
}

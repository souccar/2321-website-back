<?php

namespace App\Domain\AboutUs\Services;

use App\Domain\AboutUs\Models\About;
use App\Domain\AboutUs\Services\IAboutService;

class AboutService implements IAboutService
{
    public function GetAll($count){
        $data = About::Paginate(
            $perPage = $count
        );
        return $data; 
    }
    public function GetById($id){
        return About::find($id);
    }

    public function Create($entity){
        $result = About::create($entity);
        return $result;
    }
    public function Update($entity,$id){
        $original = About::find($id);
        $original->update($entity);
        $original->save();
        return $original;
    }
    public function Delete($id){
        $original = About::find($id);
        return $original->delete();
    }
}

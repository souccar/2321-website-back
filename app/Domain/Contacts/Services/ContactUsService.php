<?php

namespace App\Domain\Contacts\Services;

use App\Domain\Contacts\Models\ContactUs;
use App\Domain\Contacts\Services\IContactUsService;
use App\Domain\News\Models\News;

class ContactUsService implements IContactUsService
{
    public function GetAll($count){
        return ContactUs::Paginate(
            $perPage = $count
        );
    }
    public function GetById($id){
        return ContactUs::find($id);
    }

    public function Create($entity){
        $result = ContactUs::create($entity);
        return $result;
    }
    public function Update($entity,$id){
        $original = ContactUs::find($id);
        $original->update($entity);
        $original->save();
        return $original;
    }
    public function Delete($id){
        $original = ContactUs::find($id);
        return $original->delete();
    }
}

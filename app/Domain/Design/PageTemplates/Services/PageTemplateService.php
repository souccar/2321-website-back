<?php

namespace App\Domain\Design\PageTemplates\Services;

use App\Domain\Design\PageTemplates\Models\PageTemplate;
use App\Domain\Design\PageTemplates\Services\IPageTemplateService;

class PageTemplateService implements IPageTemplateService
{

    // public function GetAll(){
    //     return Page::with('Page')->Paginate();
    // }


    public function GetById($id){
        // return PageTemplate::with('childTemplates')->find($id);
    }

    public function Create($entity){
        $result = PageTemplate::create($entity);
        return $result;
    }


    public function Update($entity,$id){
        $original = PageTemplate::find($id);
        $original->update($entity);
        $original->save();
        return $original;
    }


    public function Delete($id){
        $original = PageTemplate::find($id);
        return $original->delete();
    }
}
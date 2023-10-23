<?php

namespace App\Domain\Design\Pages\Services;

use App\Domain\Design\Pages\Models\Page;
use App\Domain\Design\Pages\Services\IPageService;
use App\Domain\Design\PageTemplates\Data\ReadPageTemplateDto;
use App\Domain\Design\PageTemplates\Models\PageTemplate;
use App\Domain\Design\Templates\Models\Template;

class PageService implements IPageService
{
    public function GetAll($count){
        return Page::Paginate($perPage = $count);
    }

    public function GetById($id){
        return Page::find($id);
    }

    public function getForDrobdown(){
        return Page::select('title','slug')->get();
    }

    public function getPageBySlug($slug){
        $page = Page::where('slug',$slug)->firstOrFail();
        return $page;
    }

    public function getAssociatedTemplates($pageId){
        $allPageTemplates = [];

        $pageTemplates = PageTemplate::where('pageId',$pageId)->get();

        foreach ($pageTemplates as $pageTemplate) {
            $template = Template::where('id',$pageTemplate->templateId)->select('title')->firstOrFail();

            $dto = new ReadPageTemplateDto(
                $pageTemplate->id,
                $template->title,
                $pageTemplate->order
            );

            array_push($allPageTemplates,$dto);
        }

        return $allPageTemplates;
    }

    public function Create($entity){
        $result = Page::create($entity);
        return $this->GetById($result->id);
    }

    public function Update($entity,$id){
        $original = Page::find($id);
        $original->update($entity);
        $original->save();
        return $this->GetById($id);
    }

    public function Delete($id){
        $original = Page::find($id);
        return $original->delete();
    }
}

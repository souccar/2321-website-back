<?php

namespace App\Domain\Design\Templates\Services;

use App\Domain\Design\PageTemplates\Models\PageTemplate;
use App\Domain\Design\Templates\Models\Template;
use App\Domain\Design\Templates\Services\ITemplateService;



class TemplateService implements ITemplateService
{
    public function GetAll($count)
    {
        return Template::where('parentTemplateId', null)->Paginate($perPage = $count);
    }

    public function GetById($id)
    {
        return Template::with('childTemplates')->find($id);
    }

    public function getForDrobdown()
    {
        return Template::where('parentTemplateId', null)->select('id', 'title')->get();
    }

    public function getWithChildren($id)
    {
        $template = Template::with('childTemplates')->find($id);
        return $template;
    }

    public function GetAllForPage($pageId)
    {
        $templates = [];
        $pageTemplates = PageTemplate::where('pageId', $pageId)->get();
        foreach ($pageTemplates as $pageTemplate) {
            $template = Template::with('childTemplates')->find($pageTemplate->templateId);
            array_push($templates, $template);
        }
        return $templates;
    }

    public function Create($entity)
    {
        $result = Template::create($entity);
        return $this->GetById($result->id);
    }

    public function Update($entity,$id){
        $original = Template::find($id);
        $original->update($entity);
        $original->save();
        return $this->GetById($id);
    }
    
    public function Delete($id)
    {
        $original = Template::find($id);
        return $original->delete();
    }
}
<?php

namespace App\Domain\Design\PageTemplates\Data;


class ReadPageTemplateDto
{
    public $id;
    public $templateName;
    public $order;
    

    public function __construct($id,$templateName, $order)
    {
        $this->id = $id;
        $this->templateName = $templateName;
        $this->order = $order;
    }
}
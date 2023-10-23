<?php

namespace App\Domain\Design\Templates\Data;


class ReadChildTemplateDto
{
    public $id;
    public $type;
    public $title;
    public $description;
    public $imagePath;
    public $base64;
    public $videoPath;
    public $link_title;
    public $page_slug;
    public $numberOfColumns;
    public $parentTemplateId;

    public function __construct($id, $type,$title,$description,$imagePath,$base64,$videoPath,$link_title,$page_slug,$numberOfColumns,$parentTemplateId)
    {
        $this->id = $id;
        $this->type = $type;
        $this->title = $title;
        $this->description = $description;
        $this->imagePath = $imagePath;
        $this->base64 = $base64;
        $this->videoPath = $videoPath;
        $this->link_title = $link_title;
        $this->page_slug = $page_slug;
        $this->numberOfColumns = $numberOfColumns;
        $this->parentTemplateId = $parentTemplateId;
    }
}
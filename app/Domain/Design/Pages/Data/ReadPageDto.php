<?php

namespace App\Domain\Design\Pages\Data;


class ReadPageDto
{
    public $id;
    public $slug;
    public $title;
    public $description;
    public $imagePath;
    public $image_title;
    public $image_description;
    public $base64;

    public function __construct($id, $slug,$title,$description,$imagePath,$image_title,$image_description,$base64)
    {
        $this->id = $id;
        $this->slug = $slug;
        $this->title = $title;
        $this->description = $description;
        $this->imagePath = $imagePath;
        $this->image_title = $image_title;
        $this->image_description = $image_description;
        $this->base64 = $base64;
    }
}
<?php

namespace App\Domain\News\Data;


class ReadNewsDto
{
    public $id;
    public $title;
    public $description;
    public $imagePath;
    public $base64;

    public function __construct($id,$title,$description,$imagePath,$base64)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->imagePath = $imagePath;
        $this->base64 = $base64;
    }
}
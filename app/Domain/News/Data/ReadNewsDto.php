<?php

namespace App\Domain\News\Data;


class ReadNewsDto
{
    public $id;
    public $title;
    public $description;
    public $imagePath;
    public $displayInHome;
    public $base64;

    public function __construct($id,$title,$description,$imagePath,$displayInHome,$base64)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->imagePath = $imagePath;
        $this->displayInHome = $displayInHome;
        $this->base64 = $base64;
    }
}
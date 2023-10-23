<?php

namespace App\Domain\Catalog\Categories\Data;


class ReadCategoryDto
{
    public $id;
    public $name;
    public $description;
    public $point;
    public $imagePath;
    public $category;
    public $base64;

    public function __construct($id,$name,$description,$point,$imagePath,$category,$base64)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->point = $point;
        $this->imagePath = $imagePath;
        $this->category = $category;
        $this->base64 = $base64;
    }
}
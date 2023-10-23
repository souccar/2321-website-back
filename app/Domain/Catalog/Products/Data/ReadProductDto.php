<?php

namespace App\Domain\Catalog\Products\Data;


class ReadProductDto
{
    public $id;
    public $name;
    public $description;
    public $point;
    public $category;
    public $brand;
    public $skinType;
    public $images;
    public $sizes;

    public function __construct($id, $name,$description,$point,$category,$brand,$skinType,$images,$sizes)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->point = $point;
        $this->category = $category;
        $this->brand = $brand;
        $this->skinType = $skinType;
        $this->images = $images;
        $this->sizes = $sizes;
    }
}
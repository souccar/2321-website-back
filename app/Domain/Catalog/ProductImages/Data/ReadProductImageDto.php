<?php

namespace App\Domain\Catalog\ProductImages\Data;


class ReadProductImageDto
{
    public $id;
    public $imagePath;
    public $base64;

    public function __construct($id,$imagePath,$base64)
    {
        $this->id = $id;
        $this->imagePath = $imagePath;
        $this->base64 = $base64;
    }
}
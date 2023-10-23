<?php

namespace App\Domain\Design\Pages\Data;


class PageDropdownDto
{
    public $slug;
    public $title;

    public function __construct($slug,$title)
    {
        $this->slug = $slug;
        $this->title = $title;
    }
}
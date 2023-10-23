<?php

namespace App\Domain\News\Data;


class LastNewsDto
{
    public $title;

    public function __construct($title)
    {
        $this->title = $title;
    }
}
<?php

namespace App\Domain\Design\Sliders\Services;


interface ISliderService
{
    function GetAll($count);
    function GetById($id);
    function Create($entity);
    function Update($entity,$id);
    function Delete($id);
}

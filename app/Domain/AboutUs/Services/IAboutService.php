<?php

namespace App\Domain\AboutUs\Services;


interface IAboutService
{
    function GetAll($count);
    function GetById($id);
    function Create($entity);
    function Update($entity,$id);
    function Delete($id);
}

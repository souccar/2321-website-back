<?php

namespace App\Domain\Posts\Services;


interface IPostService
{
    function GetAll();
    function GetById($id);
    function Create($entity);
    function Update($entity,$id);
    function Delete($id);
}

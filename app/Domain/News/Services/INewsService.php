<?php

namespace App\Domain\News\Services;


interface INewsService
{
    function GetAll($count);
    function GetById($id);
    function getLastEightNews();
    function Create($entity);
    function Update($entity,$id);
    function Delete($id);
}

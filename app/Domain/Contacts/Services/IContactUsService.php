<?php

namespace App\Domain\Contacts\Services;


interface IContactUsService
{
    function GetAll($count);
    function GetById($id);
    function Create($entity);
    function Update($entity,$id);
    function Delete($id);
}

<?php

namespace App\Domain\Design\PageTemplates\Services;


interface IPageTemplateService
{
    // function GetAll();
    function GetById($id);
    // function GetTemplates();
    function Create($entity);
    function Update($entity,$id);
    function Delete($id);
}

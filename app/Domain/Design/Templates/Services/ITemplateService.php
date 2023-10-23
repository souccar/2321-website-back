<?php

namespace App\Domain\Design\Templates\Services;


interface ITemplateService
{
    function GetAll($count);
    function GetById($id);
    function GetAllForPage($pageId);
    function getForDrobdown();
    function getWithChildren($id);
    function Create($entity);
    function Update($entity,$id);
    function Delete($id);
}

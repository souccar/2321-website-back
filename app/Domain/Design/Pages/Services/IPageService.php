<?php

namespace App\Domain\Design\Pages\Services;


interface IPageService
{
    function GetAll($count);
    function GetById($id);
    function getPageBySlug($slug);
    function getForDrobdown();
    function getAssociatedTemplates($pageId);
    function Create($entity);
    function Update($entity,$id);
    function Delete($id);
}

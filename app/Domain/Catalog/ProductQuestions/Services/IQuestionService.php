<?php

namespace App\Domain\Catalog\ProductQuestions\Services;


interface IQuestionService
{
    function GetAll($count);
    function GetById($id);
    function Create($entity);
    function Update($entity,$id);
    function Delete($id);
}

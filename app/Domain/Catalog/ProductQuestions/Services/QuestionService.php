<?php

namespace App\Domain\Catalog\ProductQuestions\Services;

use App\Domain\Catalog\ProductQuestions\Models\Question;
use App\Domain\Catalog\ProductQuestions\Services\IQuestionService;


class QuestionService implements IQuestionService
{
    public function GetAll($count){
        $data = Question::with(['product' => function ($query) {
            $query->select('id', 'name');
        }])->Paginate(
            $perPage = $count
        );
        return $data; 
    }
    public function GetById($id){
        return Question::with(['product' => function ($query) {
            $query->select('id', 'name');
        }])->find($id);
    }

    public function Create($entity){
        $result = Question::create($entity);
        return $result;
    }
    public function Update($entity,$id){
        $original = Question::find($id);
        $original->update($entity);
        $original->save();
        return $original;
    }
    public function Delete($id){
        $original = Question::find($id);
        return $original->delete();
    }
}

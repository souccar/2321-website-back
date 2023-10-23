<?php

namespace App\Domain\News\Services;

use App\Domain\News\Models\News;
use App\Domain\News\Services\INewsService;

class NewsService implements INewsService
{
    public function GetAll($count){
        return News::Paginate(
            $perPage = $count
        );
    }
    public function GetById($id){
        return News::find($id);
    }

    public function getLastEightNews(){
        return News::orderBy('id', 'DESC')->take(4)->get();
    }

    public function Create($entity){
        $result = News::create($entity);
        return $result;
    }
    public function Update($entity,$id){
        $original = News::find($id);
        $original->update($entity);
        $original->save();
        return $original;
    }
    public function Delete($id){
        $original = News::find($id);
        return $original->delete();
    }
}

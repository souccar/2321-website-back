<?php

namespace App\Domain\Posts\Services;

use App\Domain\Posts\Models\Post;

class PostService implements IPostService
{
    public function GetAll(){
        return Post::all()->getTranslations();
    }
    public function GetById($id){
        return Post::find($id)->get()->getTranslations();
    }
    public function Create($entity){
        return Post::create($entity);
    }
    public function Update($entity,$id){
        $original = Post::find($id);
        $original->update($entity);
        $original->save();
        return $original;
    }
    public function Delete($id){
        $original = Post::find($id);
        $original->delete();
    }

}

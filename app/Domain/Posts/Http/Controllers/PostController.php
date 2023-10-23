<?php

namespace App\Domain\Posts\Http\Controllers;

use App\Domain\Posts\Services\IPostService;
use App\Helpers\AhcResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $_postService;
    public function __construct(IPostService $postService) {
        $this->_postService = $postService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->_postService->GetAll();
        return AhcResponse::sendResponse($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = $request->all();
        $createdPost = $this->_postService->Create($post);
        return AhcResponse::sendResponse($createdPost);
    }

    public function edit(Request $request,$id)
    {
        $post = $request->all();
        $updatedPost = $this->_postService->Update($post,$id);
        return AhcResponse::sendResponse($updatedPost);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->_postService->Delete($id);
    }
}

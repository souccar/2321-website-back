<?php

namespace App\Domain\Catalog\ProductQuestions\Http\Controllers;

use App\Domain\Catalog\ProductQuestions\Http\Requests\QuestionRequest;
use App\Domain\Catalog\ProductQuestions\Services\IQuestionService;
use App\Helpers\AhcResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    private $_questionService;

    public function __construct(IQuestionService $questionService)
    {
        $this->_questionService = $questionService;
    }
        
    public function getAll(Request $request)
    {
        $abouts = $this->_questionService->GetAll($request->count != null ? $request->count : 5);       

        return AhcResponse::sendResponse($abouts);
    }

    public function getById($id)
    {
        $about = $this->_questionService->GetById($id);
        return AhcResponse::sendResponse($about);
    }

    public function store(QuestionRequest $request)
    {
        $request->validated();

        $createdAbout = $this->_questionService->Create($request->all());

        if (!$createdAbout) {
            return AhcResponse::sendResponse([], false, ['CreatedError']);
        } else {
            return AhcResponse::sendResponse($createdAbout);
        }
    }

    public function edit(QuestionRequest $request, $id)
    {
        $request->validated();

        $updatedAbout = $this->_questionService->Update($request->all(),$id);

        if (!$updatedAbout) {
            throw AhcResponse::sendResponse([], false, ['UpdatedError']);
        }

        return AhcResponse::sendResponse($updatedAbout);
    }

    public function destroy($id)
    {
        $isDeleted = $this->_questionService->Delete($id);

        if ($isDeleted) {
            return AhcResponse::sendResponse(['Delete Successfuly']);
        } else {
            return AhcResponse::sendResponse([], false, ['DeleteError']);
        }
    }
}

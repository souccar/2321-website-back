<?php

namespace App\Domain\Design\PageTemplates\Http\Controllers;

use App\Domain\Design\PageTemplates\Http\Requests\PageTemplateRequest;
use App\Domain\Design\PageTemplates\Services\IPageTemplateService;
use App\Helpers\AhcResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageTemplateController extends Controller
{
    private $_pageTemplateService;

    public function __construct(IPageTemplateService $pageTemplateService) {
        $this->_pageTemplateService = $pageTemplateService;
    }

    public function store(PageTemplateRequest $request){

        $request->validated();   
        
        foreach ($request->pageTemplates as $pageTamplate) {

            $createdPageTemplate = $this->_pageTemplateService->Create([
                'pageId' => $pageTamplate['pageId'],
                'templateId' => $pageTamplate['templateId'],
                'order' => $pageTamplate['order'],
            ]);            
        }
        
        if (!$createdPageTemplate) {
                return AhcResponse::sendResponse([], false, ['CreatedError']);
            } else {     
                return AhcResponse::sendResponse([]);
            }
    }

    public function edit(PageTemplateRequest $request, $id)
    {
        $request->validated();

        $updatedPageTemplate = $this->_pageTemplateService->Update(
            [
                'pageId' => $request->pageId,
                'templateId' => $request->templateId,
                'order' => $request->order,
            ],
            $id
        );

        if (!$updatedPageTemplate) {
            throw AhcResponse::sendResponse([], false, ['Updated Error']);
        }

        return AhcResponse::sendResponse($updatedPageTemplate);

    }

    public function destroy($id)
    {
        $isDeleted = $this->_pageTemplateService->Delete($id);

        if ($isDeleted) {
            return response()->json([
                'success' => true,
                'message' => 'Deleted Successfuly'
            ]);
        } else {
            return AhcResponse::sendResponse([], false, ['DeleteError']);
        }
    }
}

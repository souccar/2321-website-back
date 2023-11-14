<?php

namespace App\Domain\Design\Templates\Http\Controllers;

use App\Domain\Design\Templates\Data\ReadChildTemplateDto;
use App\Domain\Design\Templates\Data\ReadTemplateDto;
use App\Domain\Design\Templates\Http\Requests\TemplateRequestr;
use App\Domain\Design\Templates\Services\ITemplateService;
use App\Helpers\AhcResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;

class TemplateController extends Controller
{
    private $_templateService;

    public function __construct(ITemplateService $templateService)
    {
        $this->_templateService = $templateService;
    }

    public function getAll(Request $request)
    {
        return AhcResponse::sendResponse($this->_templateService->GetAll($request->count != null ? $request->count : 5));
    }

    public function getForDrobdown()
    {
        return AhcResponse::sendResponse($this->_templateService->getForDrobdown());
    }

    public function getAllForPage(Request $request)
    {
        return AhcResponse::sendResponse($this->_templateService->GetAllForPage($request->pageId));
    }

    public function getWithChildren(Request $request)
    {
        $template = $this->_templateService->getWithChildren($request->id);
        
        $templateDto= new ReadTemplateDto(
            $template->id,
            $template->type,
            $template->title,
            $template->description,
            $template->imagePath,
            null,
            $template->videoPath,
            $template->link_title,
            $template->page_slug,
            $template->numberOfColumns,
            $template->parentTemplateId,
            []
        );

        if ($template) {
            if ($template->imagePath && file_exists(public_path($template->imagePath))) {
                $parentBase64 = base64_encode(file_get_contents($template->imagePath));
                $templateDto->base64 = $parentBase64;
            }

            if($template->childTemplates){
                foreach ($template->childTemplates as $child) {

                    $childTemplateDto= new ReadChildTemplateDto(
                        $child->id,
                        $child->type,
                        $child->title,
                        $child->description,
                        $child->imagePath,
                        null,
                        $child->videoPath,
                        $child->link_title,
                        $child->page_slug,
                        $child->numberOfColumns,
                        $child->parentTemplateId
                    );
                    if($child->imagePath && file_exists(public_path($child->imagePath))){
                        $childBase64 = base64_encode(file_get_contents($child->imagePath));
                        $child->base64 = $childBase64;
                    }
                    array_push($templateDto->child_templates,$childTemplateDto);
                }
            }
        }      
        
        return AhcResponse::sendResponse($templateDto);
    }

    public function store(TemplateRequestr $request)
    {

        $request->validated();

        $createdTemplate = $this->_templateService->Create([
            'type' => $request->type ? $request->type : null,
            'title' => $request->title ? $request->title : null,
            'description' => $request->description ? $request->description : null,
            'imagePath' => $request->imagePath ? $request->imagePath : null,
            'videoPath' => $request->videoPath ? $request->videoPath : null,
            'link_title' => $request->link_title ? $request->link_title : null,
            'page_slug' => $request->page_slug ? $request->page_slug : null,
            'numberOfColumns' => $request->numberOfColumns ? $request->numberOfColumns : null,
            'parentTemplateId' => null,
        ]);

        if ($request->child_templates) {

            foreach ($request->child_templates as $child) {
                $this->_templateService->Create([
                    'type' => array_key_exists('type', $child) ? $child['type'] : null,
                    'title' => array_key_exists('title', $child) ? $child['title'] : null,
                    'description' => array_key_exists('description', $child) ? $child['description'] : null,
                    'imagePath' => array_key_exists('imagePath', $child) ? $child['imagePath'] : null,
                    'videoPath' => array_key_exists('videoPath', $child) ? $child['videoPath'] : null,
                    'link_title' => array_key_exists('link_title', $child) ? $child['link_title'] : null,
                    'page_slug' => array_key_exists('page_slug', $child) ? $child['page_slug'] : null,
                    'parentTemplateId' => $createdTemplate->id,
                ]);
            }
        }

        if (!$createdTemplate) {
            throw AhcResponse::sendResponse([], false, ['CreatedError']);
        } else {
            $template = $this->_templateService->GetById($createdTemplate->id);
            return AhcResponse::sendResponse($template);
        }
    }

    public function edit(TemplateRequestr $request, $id)
    {
        $request->validated();

        // $oldTemplate = $this->_templateService->GetById($id);
        // File::delete(str_replace('\\', '/', public_path() . '/' . $oldTemplate->imagePath));


        $updatedPage = $this->_templateService->Update(
            [
                'type' => $request->type ? $request->type : null,
                'title' => $request->title ? $request->title : null,
                'description' => $request->description ? $request->description : null,
                'imagePath' => $request->imagePath ? $request->imagePath : null,
                'videoPath' => $request->videoPath ? $request->videoPath : null,
                'link_title' => $request->link_title ? $request->link_title : null,
                'page_slug' => $request->page_slug ? $request->page_slug : null,
                'numberOfColumns' => $request->numberOfColumns ? $request->numberOfColumns : null,
                'parentTemplateId' => null,
            ],
            $id
        );

        if ($request->child_templates) {

            foreach ($request->child_templates as $child) {
                $this->_templateService->Update([
                    'type' => array_key_exists('type', $child) ? $child['type'] : null,
                    'title' => array_key_exists('title', $child) ? $child['title'] : null,
                    'description' => array_key_exists('description', $child) ? $child['description'] : null,
                    'imagePath' => array_key_exists('imagePath', $child) ? $child['imagePath'] : null,
                    'videoPath' => array_key_exists('videoPath', $child) ? $child['videoPath'] : null,
                    'link_title' => array_key_exists('link_title', $child) ? $child['link_title'] : null,
                    'page_slug' => array_key_exists('page_slug', $child) ? $child['page_slug'] : null,
                    'parentTemplateId' => $updatedPage->id,
                ],
                $child->id
            );
            }
        }

        if (!$updatedPage) {
            throw AhcResponse::sendResponse([], false, ['UpdatedError']);
        }

        return AhcResponse::sendResponse($updatedPage);

    }

    public function destroy($id)
    {
        $isDeleted = $this->_templateService->Delete($id);

        if ($isDeleted) {
            return AhcResponse::sendResponse(['Delete Successfuly']);
        } else {
            return AhcResponse::sendResponse([], false, ['DeleteError']);
        }
    }

    public function uploadTemplateImage(Request $request)
    {

        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('TemplateImages'), $imageName);

            return 'TemplateImages' . '/' . $imageName;
        }
    }
}
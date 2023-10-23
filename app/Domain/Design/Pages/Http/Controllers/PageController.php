<?php

namespace App\Domain\Design\Pages\Http\Controllers;

use App\Domain\Design\Pages\Data\PageDropdownDto;
use App\Domain\Design\Pages\Data\ReadPageDto;
use App\Domain\Design\Pages\Http\Requests\PageRequestr;
use App\Domain\Design\Pages\Models\Page;
use App\Domain\Design\Pages\Services\IPageService;
use App\Domain\Design\Templates\Services\ITemplateService;
use App\Helpers\AhcResponse;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Nette\Utils\Random;

class PageController extends Controller
{
    private $_pageService;
    private $_templateService;

    // private static bool $imageUpdated = false;

    public function __construct(IPageService $pageService, ITemplateService $templateService)
    {
        $this->_pageService = $pageService;
        $this->_templateService = $templateService;
    }

    public function getAll(Request $request)
    {
        return AhcResponse::sendResponse($this->_pageService->GetAll($request->count != null ? $request->count : 5));
    }

    public function getForDrobdown()
    {
        $dto = [];
        $homePage = new PageDropdownDto('home','Home');
        array_push($dto, $homePage);

        $pages = $this->_pageService->getForDrobdown();
        foreach ($pages as $page) {
            $pageDropDown = new PageDropDownDto($page->slug, $page->title);
            array_push($dto, $pageDropDown);
        }
        
        return AhcResponse::sendResponse($dto);
    }

    public function getPageBySlug($slug)
    {
        $page = $this->_pageService->getPageBySlug($slug);
        return AhcResponse::sendResponse($page);
    }

    public function getForEdit($id)
    {
        $page = $this->_pageService->GetById($id);
        if ($page) {

            if ($page->imagePath != null && file_exists($page->imagePath)) {

                $base64 = base64_encode(file_get_contents($page->imagePath));

                $data = new ReadPageDto(
                    $page->id,
                    $page->slug,
                    $page->title,
                    $page->description,
                    $page->imagePath,
                    $page->image_title,
                    $page->image_description,
                    $base64
                );

                return AhcResponse::sendResponse($data);
            } else {

                $data = new ReadPageDto(
                    $page->id,
                    $page->slug,
                    $page->title,
                    $page->description,
                    $page->imagePath,
                    $page->image_title,
                    $page->image_description,
                    null
                );

                return AhcResponse::sendResponse($data);
            }
        } else {

            return AhcResponse::sendResponse([], false, ['id: ' . $id . ' NotFound']);
        }
    }


    public function getAssociatedTemplates($pageId)
    {

        return AhcResponse::sendResponse($this->_pageService->getAssociatedTemplates($pageId));
    }

    public function store(PageRequestr $request)
    {

        $request->validated();

        if ($request->title != null) {
            $slug = Str::lower(str_replace(' ', '-', $request->title));
        } else {
            $slug = Random::generate();
        }

        $createdPage = $this->_pageService->Create([
            'slug' => $slug,
            'title' => $request->title,
            'description' => $request->description,
            'imagePath' => $request->imagePath,
            'image_title' => $request->image_title,
            'image_description' => $request->image_description,
        ]);

        if (!$createdPage) {
            return AhcResponse::sendResponse([], false, ['CreatedError']);
        } else {
            return AhcResponse::sendResponse($createdPage);
        }
    }

    public function edit(PageRequestr $request, $id)
    {
        $request->validated();

        // if (self::$imageUpdated == true) {
        //     $oldPage = $this->_pageService->GetById($id);
        //     File::delete(str_replace('\\', '/', public_path() . '/' . $oldPage->imagePath));
        // }

        if ($request->title != null) {
            $slug = Str::lower(str_replace(' ', '-', $request->title));
        } else {
            $slug = Random::generate();
        }

        $updatedPage = $this->_pageService->Update(
            [
                'slug' => $slug,
                'title' => $request->title,
                'description' => $request->description,
                'imagePath' => $request->imagePath,
                'image_title' => $request->image_title,
                'image_description' => $request->image_description,
            ],
            $id
        );

        if (!$updatedPage) {
            throw AhcResponse::sendResponse([], false, ['UpdatedError']);
        }

        return AhcResponse::sendResponse($updatedPage);

    }

    public function destroy($id)
    {
        $oldPage = $this->_pageService->GetById($id);
        $isDeleted = $this->_pageService->Delete($id);

        if ($isDeleted) {
            File::delete(str_replace('\\', '/', public_path() . '/' . $oldPage->imagePath));
            return response()->json([
                'success' => true,
                'message' => 'Delete Successfuly'
            ]);
        } else {
            return AhcResponse::sendResponse([], false, ['DeleteError']);
        }
    }

    public function uploadPageImage(Request $request)
    {

        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('PageImages'), $imageName);

            // self::$imageUpdated = true;

            return 'PageImages' . '/' . $imageName;
        }
    }
}
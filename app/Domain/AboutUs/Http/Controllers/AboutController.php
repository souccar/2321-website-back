<?php

namespace App\Domain\AboutUs\Http\Controllers;

use App\Domain\AboutUs\Http\Requests\AboutRequest;
use App\Domain\AboutUs\Services\IAboutService;
use App\Helpers\AhcResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    private $_aboutService;

    public function __construct(IAboutService $aboutService)
    {
        $this->_aboutService = $aboutService;
    }
        
    public function getAll(Request $request)
    {
        $abouts = $this->_aboutService->GetAll($request->count != null ? $request->count : 5);       

        return AhcResponse::sendResponse($abouts);
    }

    public function getById($id)
    {
        $about = $this->_aboutService->GetById($id);
        return AhcResponse::sendResponse($about);
    }

    public function store(AboutRequest $request)
    {
        $request->validated();

        $createdAbout = $this->_aboutService->Create($request->all());

        if (!$createdAbout) {
            return AhcResponse::sendResponse([], false, ['CreatedError']);
        } else {
            return AhcResponse::sendResponse($createdAbout);
        }
    }

    public function edit(AboutRequest $request, $id)
    {
        $request->validated();

        $updatedAbout = $this->_aboutService->Update($request->all(),$id);

        if (!$updatedAbout) {
            throw AhcResponse::sendResponse([], false, ['UpdatedError']);
        }

        return AhcResponse::sendResponse($updatedAbout);
    }

    public function destroy($id)
    {
        $isDeleted = $this->_aboutService->Delete($id);

        if ($isDeleted) {
            return AhcResponse::sendResponse(['Delete Successfuly']);
        } else {
            return AhcResponse::sendResponse([], false, ['DeleteError']);
        }
    }

    public function uploadAboutUsImage(Request $request)
    {
        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('AboutUsImages'), $imageName);

            return 'AboutUsImages' . '/' . $imageName;
        }
    }

}

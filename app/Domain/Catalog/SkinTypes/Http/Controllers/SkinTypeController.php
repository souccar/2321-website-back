<?php

namespace App\Domain\Catalog\SkinTypes\Http\Controllers;

use App\Domain\Catalog\SkinTypes\Http\Requests\SkinTypeRequest;
use App\Domain\Catalog\SkinTypes\Services\ISkinTypeService;
use App\Helpers\AhcResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SkinTypeController extends Controller
{
    private $_skinTypeService;
    public function __construct(ISkinTypeService $skinTypeService)
    {
        $this->_skinTypeService = $skinTypeService;
    }

    public function getAll(Request $request)
    {
        $skinTypes = $this->_skinTypeService->GetAll($request->count != null ? $request->count:5);
        if ($skinTypes) {
            if ($skinTypes->count() == 0)
                return AhcResponse::sendResponse();
            return AhcResponse::sendResponse($skinTypes);
        } else {
            return AhcResponse::sendResponse([],false, ['Error']);
        }
    }

    public function getById($id)
    {
        $skinType = $this->_skinTypeService->GetById($id);
        if ($skinType != null)
            return AhcResponse::sendResponse($skinType);
        return AhcResponse::sendResponse([], false, ['id: ' . $id . ' NotFound']);
    }


    public function store(SkinTypeRequest $request)
    {
        $request->validated();

        $createdSkinType = $this->_skinTypeService->Create([
            'name' => $request->name,
        ]);

        if (!$createdSkinType) {
            throw AhcResponse::sendResponse([],false,['CreatedError']);
        }

        return AhcResponse::sendResponse($createdSkinType);
    }


    public function edit(SkinTypeRequest $request, $id)
    {
        $request->validated();

        $updatedSkinType = $this->_skinTypeService->Update(
            [
                'name' => $request->name,
            ],
            $id
        );

        if (!$updatedSkinType) {
            throw AhcResponse::sendResponse([],false,['UpdatedError']);
        }

        return AhcResponse::sendResponse($updatedSkinType);
    }


    public function destroy($id)
    {
        $isDeleted = $this->_skinTypeService->Delete($id);
        
        if ($isDeleted) {
            return response()->json([
                'success'=> true,
                'message'=>'Delete Successfuly'
            ]);
        }else{
            return AhcResponse::sendResponse([],false,['DeleteError']);
        }
    }
}

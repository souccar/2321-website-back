<?php

namespace App\Domain\Catalog\Brands\Http\Controllers;

use App\Domain\Catalog\Brands\Http\Requests\BrandRequest;
use App\Domain\Catalog\Brands\Services\IBrandService;
use App\Helpers\AhcResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    private $_brandService;
    public function __construct(IBrandService $brandService)
    {
        $this->_brandService = $brandService;
    }

    public function getAll(Request $request)
    {
        $brands = $this->_brandService->GetAll($request->count != null ? $request->count:5);
        if ($brands) {
            if ($brands->count() == 0)
                return AhcResponse::sendResponse();
            return AhcResponse::sendResponse($brands);
        } else {
            return AhcResponse::sendResponse([],false, ['Error']);
        }
    }

    public function getById($id)
    {
        $brand = $this->_brandService->GetById($id);
        if ($brand != null)
            return AhcResponse::sendResponse($brand);
        return AhcResponse::sendResponse([], false, ['id: ' . $id . ' NotFound']);
    }


    public function store(BrandRequest $request)
    {
        $request->validated();

        $createdBrand = $this->_brandService->Create([
            'name' => $request->name,
        ]);

        if (!$createdBrand) {
            throw AhcResponse::sendResponse([],false,['CreatedError']);
        }

        return AhcResponse::sendResponse($createdBrand);
    }


    public function edit(BrandRequest $request, $id)
    {
        $request->validated();

        $updatedBrand = $this->_brandService->Update(
            [
                'name' => $request->name,
            ],
            $id
        );

        if (!$updatedBrand) {
            throw AhcResponse::sendResponse([],false,['UpdatedError']);
        }

        return AhcResponse::sendResponse($updatedBrand);
    }


    public function destroy($id)
    {
        $isDeleted = $this->_brandService->Delete($id);
        
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

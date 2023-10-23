<?php

namespace App\Domain\Catalog\ProductSizes\Http\Controllers;

use App\Domain\Catalog\ProductSizes\Http\Requests\ProductSizeRequest;
use App\Domain\Catalog\ProductSizes\Services\IProductSizeService;
use App\Http\Controllers\Controller;

class ProductSizeController extends Controller
{
    private $_productSizeService;
    public function __construct(IProductSizeService $productSizeService)
    {
        $this->_productSizeService = $productSizeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function getAll()
    {
        $productSizes = $this->_productSizeService->GetAll();
        return response()->json($productSizes);
    }

    /**
     * Display the specified resource.
     */
    public function getById($id)
    {
        $productSize = $this->_productSizeService->GetById($id);
        return response()->json($productSize);
    }

    public function GetByProductId($productId){
        $productsizes = $this->_productSizeService->GetByProductId($productId);
        return response()->json($productsizes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductSizeRequest $request)
    {
        $productSize = $request->validated();

        return $this->_productSizeService->Create($productSize);
    }

    public function edit(ProductSizeRequest $request, $id)
    {
        $productSize = $request->validated();

        return $this->_productSizeService->Update($productSize,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->_productSizeService->Delete($id);
    }
}

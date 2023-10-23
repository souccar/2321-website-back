<?php

namespace App\Domain\Catalog\ProductImages\Http\Controllers;

use App\Domain\Catalog\ProductImages\Http\Requests\ProductImageRequest;
use App\Domain\Catalog\ProductImages\Services\IProductImageService;
use App\Http\Controllers\Controller;

class ProductImageController extends Controller
{
    private $_productImageService;
    public function __construct(IProductImageService $productImageService)
    {
        $this->_productImageService = $productImageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function getAll()
    {
        $productImages = $this->_productImageService->GetAll();
        return response()->json($productImages);
    }

    /**
     * Display the specified resource.
     */
    public function getById($id)
    {
        $productImage = $this->_productImageService->GetById($id);
        return response()->json($productImage);
    }

    public function GetByProductId($productId)
    {
        $productImages = $this->_productImageService->GetByProductId($productId);
        return response()->json($productImages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductImageRequest $request)
    {
        $productImage = $request->validated();

        $imageName = time() . '.' . $productImage->image->extension();
        $productImage->image->move(public_path('productImages'), $imageName);

        return $this->_productImageService->Create([
            'imagePath' => 'productImages' . '/' . $imageName,
            'productId' => $productImage->productId
        ]);

    }

    public function edit(ProductImageRequest $request, $id)
    {
        $productImage = $request->validated();

        $imageName = time() . '.' . $productImage->image->extension();
        $productImage->image->move(public_path('productImages'), $imageName);

        return $this->_productImageService->Update([
            'imagePath' => 'productImages' . '/' . $imageName,
            'productId' => $productImage->productId
        ], $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->_productImageService->Delete($id);
    }
}
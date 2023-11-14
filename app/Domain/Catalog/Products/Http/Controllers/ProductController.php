<?php

namespace App\Domain\Catalog\Products\Http\Controllers;

use App\Domain\Catalog\ProductImages\Data\ReadProductImageDto;
use App\Domain\Catalog\Products\Data\ReadProductDto;
use App\Domain\Catalog\Products\Events\CreateImagesEvent;
use App\Domain\Catalog\Products\Events\CreateSizesEvent;
use App\Domain\Catalog\Products\Events\SizesEvent;
use App\Domain\Catalog\Products\Events\UpdateImagesEvent;
use App\Domain\Catalog\Products\Events\UpdateSizesEvent;
use App\Domain\Catalog\Products\Http\Requests\ProductRequest;
use App\Domain\Catalog\Products\Services\IProductService;
use App\Helpers\AhcResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $_productService;

    public function __construct(
        IProductService $productService
    ) {
        $this->_productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function getAll(Request $request)
    {
        $products = $this->_productService->GetAll($request->count != null ? $request->count : 5);
        if ($products) {
            if ($products->count() == 0)
                return AhcResponse::sendResponse();
            return AhcResponse::sendResponse($products);
        } else {
            return AhcResponse::sendResponse([],false, ['Error']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function getById($id)
    {
        $product = $this->_productService->GetById($id);        

        if ($product){

            $productDto= new ReadProductDto(
                $product->id,
                $product->name,
                $product->description,
                $product->point,
                $product->category,
                $product->brand,
                $product->skinType,
                [],
                []
            );

            if ($product->productImages->count() != 0){
                
            foreach ($product->productImages as $image) {

                if ($image->imagePath != null && file_exists($image->imagePath)) {

                    $base64 = base64_encode(file_get_contents($image->imagePath));
    
                    $data = new ReadProductImageDto(
                        $image->id,
                        $image->imagePath,
                        $base64
                    );
                    
                    array_push($productDto->images,$data);
                }else {
                    $data = new ReadProductImageDto(
                        $image->id,
                        $image->imagePath,
                        null
                    );
                    array_push($productDto->images,$data);
                }
            }
        }
            return AhcResponse::sendResponse($productDto);
        }
        return AhcResponse::sendResponse([], false, ['id: ' . $id . ' NotFound']);
    }

    public function getByCategoryId(Request $request)
    {
        $products = $this->_productService->getByCategoryId($request->categoryId,$request->count != null ? $request->count : 5);
        if ($products) {
            if ($products->count() == 0)
                return AhcResponse::sendResponse();
            return AhcResponse::sendResponse($products);
        } else {
            return AhcResponse::sendResponse([],false, ['Error']);
        }
    }

    public function getByBrandId(Request $request)
    {
        $products = $this->_productService->getByBrandId($request->brandId,$request->count != null ? $request->count : 5);
        if ($products) {
            if ($products->count() == 0)
                return AhcResponse::sendResponse();
            return AhcResponse::sendResponse($products);
        } else {
            return AhcResponse::sendResponse([],false, ['Error']);
        }
    }

    public function getBySkinTypeId(Request $request)
    {
        $products = $this->_productService->getBySkinTypeId($request->skinTypeId,$request->count != null ? $request->count : 5);
        if ($products) {
            if ($products->count() == 0)
                return AhcResponse::sendResponse();
            return AhcResponse::sendResponse($products);
        } else {
            return AhcResponse::sendResponse([],false, ['Error']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $request->validated();

        // if ($request->sizes) {

        //     $units = ['ml','l','g','kg'];

        //     foreach ($request->sizes as $size) {

        //         $validator = Validator::make($size, [
        //             'size' => 'required|numeric',
        //             'unit' => 'required'
        //         ]);

        //         if ($validator->fails()) {
        //             return AhcResponse::sendResponse([], false, $validator->errors());
        //         }

        //         if(!in_array($size['unit'],$units)){
        //             return AhcResponse::sendResponse([],false,['unit must be within one of the following values : [ml,l,g,kg]']);
        //         }
        //     }
        // }

        $createdProduct = $this->_productService->Create([
            'name' => $request->name,
            'description' => $request->description,
            'point' => $request->point,
            'categoryId' => $request->categoryId,
            'brandId' => $request->brandId,
            'skinTypeId' => $request->skinTypeId,
        ]);

        if (!$createdProduct) {
            return AhcResponse::sendResponse([], false, ['CreatedError']);
        }

        if ($request->images) {
            event(new CreateImagesEvent($request->images,$createdProduct->id));
        }

        // if ($request->sizes) {
        //     event(new CreateSizesEvent($request->sizes,$createdProduct->id));
        // }

        $newProduct = $this->_productService->GetById($createdProduct->id);
        return AhcResponse::sendResponse($newProduct);
    }

    public function edit(ProductRequest $request, $id)
    {
        $request->validated();

        // if ($request->sizes) {

        //     $units = ['ml','l','g','kg'];

        //     foreach ($request->sizes as $size) {

        //         $validator = Validator::make($size, [
        //             'size' => 'required|numeric',
        //             'unit' => 'required'
        //         ]);

        //         if ($validator->fails()) {
        //             return AhcResponse::sendResponse([], false, $validator->errors());
        //         }

        //         if(!in_array($size['unit'],$units)){
        //             return AhcResponse::sendResponse([],false,['unit must be within one of the following values : [ml,l,g,kg]']);
        //         }
        //     }
        // }

        $updatedProduct = $this->_productService->Update([
            'name' => $request->name,
            'description' => $request->description,
            'point' => $request->point,
            'categoryId' => $request->categoryId,
            'brandId' => $request->brandId,
            'skinTypeId' => $request->skinTypeId,
        ], $id);

        if (!$updatedProduct) {
            return AhcResponse::sendResponse([], false, ['UpdatedError']);
        }

        if ($request->images) {
            event(new UpdateImagesEvent($request->images,$updatedProduct->id));
        }

        // if ($request->sizes) {
        //     event(new UpdateSizesEvent($request->sizes,$updatedProduct->id));
        // }

        $newProduct = $this->_productService->GetById($updatedProduct->id);
        
        return AhcResponse::sendResponse($newProduct);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $isDeleted = $this->_productService->Delete($id);

        if ($isDeleted) {
            return AhcResponse::sendResponse(['Delete Successfuly']);
        } else {
            return AhcResponse::sendResponse([], false, ['DeleteError']);
        }
    }

    public function uploadProductImages(Request $request)
    {
        $paths = [];
        $images = $request->allFiles();
        
        foreach ($images as $image) {
            $imageName = time().'.'.$image->extension(); 
            $image->move(public_path('ProductImages'), $imageName);
            array_push($paths,'ProductImages' . '/' . $imageName);
            sleep(1);
            // time_nanosleep(1,0);
        } 
        return $paths;  
    }

}
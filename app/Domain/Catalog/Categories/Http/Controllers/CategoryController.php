<?php

namespace App\Domain\Catalog\Categories\Http\Controllers;

use App\Domain\Catalog\Categories\Data\ReadCategoryDto;
use App\Domain\Catalog\Categories\Http\Requests\CategoryRequest;
use App\Domain\Catalog\Categories\Services\ICategoryService;
use App\Helpers\AhcResponse;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $_categoryService;
    public function __construct(ICategoryService $categoryService)
    {
        $this->_categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function getAll(Request $request)
    {
        $allData = [];

        $categories = $this->_categoryService->GetAll($request->count != null ? $request->count : 5);
        if ($categories) {
            if ($categories->count() == 0)
                return AhcResponse::sendResponse();

            foreach ($categories as $category) {

                if ($category->imagePath != null && file_exists(public_path($category->imagePath))) {

                    $base64 = base64_encode(file_get_contents($category->imagePath));

                    $data = new ReadCategoryDto(
                        $category->id,
                        $category->name,
                        $category->description,
                        $category->point,
                        $category->imagePath,
                        $category->category,
                        $base64
                    );

                    array_push($allData, $data);

                } else {

                    $data = new ReadCategoryDto(
                        $category->id,
                        $category->name,
                        $category->description,
                        $category->point,
                        $category->imagePath,
                        $category->category,
                        null
                    );

                    array_push($allData, $data);
                }
            }
            return AhcResponse::sendResponse($allData);
        } else {
            return AhcResponse::sendResponse([], false, ['Error']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function getById($id)
    {
        $category = $this->_categoryService->GetById($id);

        if ($category) {

            if ($category->imagePath != null && file_exists($category->imagePath)) {

                $base64 = base64_encode(file_get_contents($category->imagePath));

                $data = new ReadCategoryDto(
                    $category->id,
                    $category->name,
                    $category->description,
                    $category->point,
                    $category->imagePath,
                    $category->category,
                    $base64
                );

                return AhcResponse::sendResponse($data);

            } else {

                $data = new ReadCategoryDto(
                    $category->id,
                    $category->name,
                    $category->description,
                    $category->point,
                    $category->imagePath,
                    $category->category,
                    null
                );

                return AhcResponse::sendResponse($data);
            }
        }

        return AhcResponse::sendResponse([], false, ['id: ' . $id . ' NotFound']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $request->validated();

        $createdCategory = $this->_categoryService->Create([
            'name' => $request->name,
            'description' => $request->description,
            'point' => $request->point,
            'imagePath' => null,
            'parentCategoryId' => $request->parentCategoryId
        ]);

        if ($request->hasFile('image')) {
            $imageName = $createdCategory->id . '-' . $request->file('image')->getSize() . '_'
                . Str::lower($request->file('image')->getClientOriginalName());

            $createdCategory->imagePath = 'categoryImages' . '/' . $imageName;
            $createdCategory->save();
        }

        if (!$createdCategory) {
            throw AhcResponse::sendResponse([], false, ['CreatedError']);
        } else {
            if ($request->hasFile('image')) {
                $request->image->move(public_path('categoryImages'), $imageName);
            }
            return AhcResponse::sendResponse($createdCategory);
        }
    }

    public function edit(CategoryRequest $request, $id)
    {
        $request->validated();

        $oldCategory = $this->_categoryService->GetById($id);

        // if ($oldCategory->imagePath != null && !$request->hasFile('image')) {
        //     if (file_exists(public_path($oldCategory->imagePath))) {
        //         File::delete(str_replace('\\', '/', public_path() . '/' . $oldCategory->imagePath));
        //     }
        // }

        if ($request->hasFile('image')) {
            $newImage = $request->id . '-' . $request->file('image')->getSize() . '_' . Str::lower($request->file('image')->getClientOriginalName());

            if (!file_exists(public_path('categoryImages/' . $newImage))) {

                $request->image->move(public_path('categoryImages'), $newImage);
                $oldCategory->imagePath != null ? File::delete(str_replace('\\', '/', public_path() . '/' . $oldCategory->imagePath)) : null;
            }

        }

        $updatedCategory = $this->_categoryService->Update(
            [
                'name' => $request->name,
                'description' => $request->description,
                'point' => $request->point,
                'imagePath' => $request->hasFile('image') ? 'categoryImages' . '/' . $newImage : $oldCategory->imagePath,
                'parentCategoryId' => $request->parentCategoryId
            ],
            $id
        );

        if (!$updatedCategory) {
            throw AhcResponse::sendResponse([], false, ['UpdatedError']);
        }

        return AhcResponse::sendResponse($updatedCategory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $isDeleted = $this->_categoryService->Delete($id);

        if ($isDeleted) {
            return response()->json([
                'success' => true,
                'message' => 'Delete Successfuly'
            ]);
        } else {
            return AhcResponse::sendResponse([], false, ['DeleteError']);
        }
    }
}
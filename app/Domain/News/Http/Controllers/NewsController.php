<?php

namespace App\Domain\News\Http\Controllers;

use App\Domain\News\Data\ReadNewsDto;
use App\Domain\News\Http\Requests\NewsRequest;
use App\Domain\News\Services\INewsService;
use App\Helpers\AhcResponse;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    private $_NewsService;
    public function __construct(INewsService $NewsService)
    {
        $this->_NewsService = $NewsService;
    }

    /**
     * Display a listing of the resource.
     */
    public function getAll(Request $request)
    {
        $news = $this->_NewsService->GetAll($request->count != null ? $request->count : 5);       

        return AhcResponse::sendResponse($news);
    }

    /**
     * Display the specified resource.
     */
    public function getById($id)
    {
        $News = $this->_NewsService->GetById($id);

        if ($News) {

            if ($News->imagePath != null && file_exists($News->imagePath)) {

                $base64 = base64_encode(file_get_contents($News->imagePath));

                $data = new ReadNewsDto(
                    $News->id,
                    $News->title,
                    $News->description,
                    $News->imagePath,
                    $News->displayInHome,
                    $base64
                );

                return AhcResponse::sendResponse($data);
            } else {

                $data = new ReadNewsDto(
                    $News->id,
                    $News->title,
                    $News->description,
                    $News->imagePath,
                    $News->displayInHome,
                    null
                );

                return AhcResponse::sendResponse($data);
            }
        }
        return AhcResponse::sendResponse([], false, ['id: ' . $id . ' NotFound']);
    }

    public function getLastEightNews()
    {
        $lastNews = $this->_NewsService->getLastEightNews();
        if ($lastNews) {

            if ($lastNews->count() == 0)
                return AhcResponse::sendResponse();

            foreach ($lastNews as $item) {
                if ($item->imagePath != null && file_exists(public_path($item->imagePath))) {
                    $item->imagePath = $item->imagePath;
                } else {
                    $item->imagePath = null;
                }
            }

            return AhcResponse::sendResponse($lastNews);
        } else {
            return AhcResponse::sendResponse([], false, ['Error']);
        }
    }

    public function getOnlyForHome(){
        $newsForHOme = $this->_NewsService->getOnlyForHome();
        if ($newsForHOme) {
            if ($newsForHOme->count() == 0)
                return AhcResponse::sendResponse();

            foreach ($newsForHOme as $item) {
                if ($item->imagePath != null && file_exists(public_path($item->imagePath))) {
                    $item->imagePath = $item->imagePath;
                } else {
                    $item->imagePath = null;
                }
            }
            return AhcResponse::sendResponse($newsForHOme);
        } else {
            return AhcResponse::sendResponse([], false, ['Error']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $request)
    {
        $request->validated();

        $createdNews = $this->_NewsService->Create([
            'title' => $request->title,
            'description' => $request->description,
            'imagePath' => null,
            'displayInHome' => $request->displayInHome
        ]);


        if ($request->hasFile('image')) {
            $imageName = $createdNews->id . '-' . $request->file('image')->getSize() . '_'
                . Str::lower($request->file('image')->getClientOriginalName());

            $createdNews->imagePath = 'NewsImages' . '/' . $imageName;
            $createdNews->save();

            $request->image->move(public_path('NewsImages'), $imageName);
        }

        if (!$createdNews) {
            throw AhcResponse::sendResponse([], false, ['CreatedError']);
        } else {
            return AhcResponse::sendResponse($createdNews);
        }
    }

    public function edit(NewsRequest $request, $id)
    {
        $request->validated();

        $oldNews = $this->_NewsService->GetById($id);

        // if ($oldNews->imagePath != null && !$request->hasFile('image')) {
        //     if (file_exists(public_path($oldNews->imagePath))) {
        //         File::delete(str_replace('\\', '/', public_path() . '/' . $oldNews->imagePath));
        //     }
        // }

        if ($request->hasFile('image')) {
            $newImage = $request->id . '-' . $request->file('image')->getSize() . '_' . Str::lower($request->file('image')->getClientOriginalName());

            if (!file_exists(public_path('NewsImages/' . $newImage))) {

                $request->image->move(public_path('NewsImages'), $newImage);
                $oldNews->imagePath != null ? File::delete(str_replace('\\', '/', public_path() . '/' . $oldNews->imagePath)) : null;
            }
        }

        $updatedNews = $this->_NewsService->Update(
            [
                'title' => $request->title,
                'description' => $request->description,
                'imagePath' => $request->hasFile('image') ? 'NewsImages' . '/' . $newImage : $oldNews->imagePath,
                'displayInHome' => $request->displayInHome
            ],
            $id
        );

        if (!$updatedNews) {
            throw AhcResponse::sendResponse([], false, ['UpdatedError']);
        }

        return AhcResponse::sendResponse($updatedNews);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $isDeleted = $this->_NewsService->Delete($id);

        if ($isDeleted) {
            return AhcResponse::sendResponse(['Delete Successfuly']);
        } else {
            return AhcResponse::sendResponse([], false, ['DeleteError']);
        }

    }
}
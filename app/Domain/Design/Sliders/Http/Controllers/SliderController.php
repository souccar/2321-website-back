<?php

namespace App\Domain\Design\Sliders\Http\Controllers;

use App\Domain\Design\Sliders\Http\Requests\SliderRequest;
use App\Domain\Design\Sliders\Services\ISliderService;
use App\Helpers\AhcResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    private $_sliderService;

    public function __construct(ISliderService $sliderService)
    {
        $this->_sliderService = $sliderService;
    }

    public function getAll()
    {
        $slider = $this->_sliderService->GetAll();
        return AhcResponse::sendResponse($slider);
    }

    public function store(SliderRequest $request)
    {
        $request->validated();

        $createdSlider = $this->_sliderService->Create($request->all());

        if (!$createdSlider) {
            return AhcResponse::sendResponse([], false, ['CreatedError']);
        } else {
            return AhcResponse::sendResponse($createdSlider);
        }
    }

    public function edit(SliderRequest $request, $id)
    {
        $request->validated();

        $updatedSlider = $this->_sliderService->Update($request->all(),$id);

        if (!$updatedSlider) {
            throw AhcResponse::sendResponse([], false, ['UpdatedError']);
        }

        return AhcResponse::sendResponse($updatedSlider);
    }

    public function destroy($id)
    {
        $isDeleted = $this->_sliderService->Delete($id);

        if ($isDeleted) {
            return response()->json([
                'success' => true,
                'message' => 'Delete Successfuly'
            ]);
        } else {
            return AhcResponse::sendResponse([], false, ['DeleteError']);
        }
    }

    public function uploadSliderImage(Request $request)
    {
        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('SliderImages'), $imageName);

            return 'SliderImages' . '/' . $imageName;
        }
    }
}

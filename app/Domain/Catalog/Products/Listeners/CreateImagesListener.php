<?php

namespace App\Domain\Catalog\Products\Listeners;

use App\Domain\Catalog\ProductImages\Services\IProductImageService;
use App\Domain\Catalog\Products\Events\CreateImagesEvent;
use App\Helpers\AhcResponse;
use Illuminate\Support\Str;

class CreateImagesListener
{
    private $_productImageService;
    

    /**
     * Create the event listener.
     */
    public function __construct(IProductImageService $productImageService)
    {
        $this->_productImageService = $productImageService;        
    }

    /**
     * Handle the event.
     */
    public function handle(CreateImagesEvent $event)
    {
        foreach ($event->images as $imagePath) {

            // $imageName = 
            // $event->productId.'-'. $image->getSize().'_'.Str::lower($image->getClientOriginalName());

            // $image->move(public_path('productImages'), $imageName);

            $createdProductImage = $this->_productImageService->Create([
                'imagePath' => $imagePath,
                'productId' => $event->productId
            ]);

            if (!$createdProductImage) {
                return AhcResponse::sendResponse([], false, ['CreatedError(Image)']);
            }
        }
    }
}

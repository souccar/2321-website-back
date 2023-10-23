<?php

namespace App\Domain\Catalog\Products\Listeners;

use App\Domain\Catalog\ProductImages\Services\IProductImageService;
use App\Domain\Catalog\Products\Events\UpdateImagesEvent;
use App\Helpers\AhcResponse;
use File;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class UpdateImagesListener
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
    public function handle(UpdateImagesEvent $event)
    {
        foreach ($event->images as $imagePath) {

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
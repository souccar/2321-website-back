<?php

namespace App\Domain\Catalog\Products\Listeners;

use App\Domain\Catalog\Products\Events\CreateSizesEvent;
use App\Domain\Catalog\ProductSizes\Services\IProductSizeService;
use App\Helpers\AhcResponse;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateSizesListener
{
    private $_productSizeService;
    private $sizenum;
    private $unitnum;

    /**
     * Create the event listener.
     */
    public function __construct(IProductSizeService $productSizeService)
    {
        $this->_productSizeService = $productSizeService;
    }

    /**
     * Handle the event.
     */
    public function handle(CreateSizesEvent $event)
    {
        foreach ($event->sizes as $size) {            
            $this->sizenum = $size['size'];
            $this->unitnum = $size['unit'];

        $result = $this->_productSizeService->Create([
            'size' => $this->sizenum,
            'unit' => $this->unitnum,
            'ProductId' => $event->productId
        ]);

        if(!$result){
            return AhcResponse::sendResponse([],false,['Error Create Size']);
        }
      }
    }
}

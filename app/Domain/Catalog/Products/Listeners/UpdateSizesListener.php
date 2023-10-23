<?php

namespace App\Domain\Catalog\Products\Listeners;

use App\Domain\Catalog\Products\Events\UpdateSizesEvent;
use App\Domain\Catalog\ProductSizes\Models\ProductSize;
use App\Domain\Catalog\ProductSizes\Services\IProductSizeService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateSizesListener
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
    public function handle(UpdateSizesEvent $event): void
    {
        $oldSizes = $this->_productSizeService->GetByProductId($event->productId);
        $q= $oldSizes->all();

        $sizes=[]; $units=[];

        foreach ($event->sizes as $size) {
            array_push($sizes,$size['size']);
            array_push($units,$size['unit']);
        }

        foreach ($oldSizes as $old) {
            $t= in_array($old->size,$sizes); 
            $w= in_array($old->unit,$units); 
        }

    }
}

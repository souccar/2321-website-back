<?php

namespace App\Domain\Design\Pages\Jobs;

use App\Domain\Design\Pages\Services\IPageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DeletePageIamgesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // public $_pageService;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        // $this->_pageService = $pageService;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $pages = $this->_pageService->GetAll(10000);

        // foreach ($pages as $page) {
        //    $e = file_exists(public_path($page->imagePath));
        // //    Storage::allFiles('public/PageImages');
        // }
    }
}

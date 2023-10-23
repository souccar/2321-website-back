<?php

namespace App\Providers;

use App\Domain\Catalog\Products\Events\CreateImagesEvent;
use App\Domain\Catalog\Products\Events\CreateSizesEvent;
use App\Domain\Catalog\Products\Events\UpdateImagesEvent;
use App\Domain\Catalog\Products\Events\UpdateSizesEvent;
use App\Domain\Catalog\Products\Listeners\CreateImagesListener;
use App\Domain\Catalog\Products\Listeners\CreateSizesListener;
use App\Domain\Catalog\Products\Listeners\UpdateImagesListener;
use App\Domain\Catalog\Products\Listeners\UpdateSizesListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CreateImagesEvent::class => [
            CreateImagesListener::class
        ],
        UpdateImagesEvent::class => [
            UpdateImagesListener::class
        ],
        CreateSizesEvent::class => [
            CreateSizesListener::class
        ],
        UpdateSizesEvent::class => [
            UpdateSizesListener::class
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

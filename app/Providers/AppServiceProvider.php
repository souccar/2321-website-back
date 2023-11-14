<?php

namespace App\Providers;

use App\Domain\Authorization\Permission\Services\PermissionService;
use App\Domain\Authorization\Permissions\Services\IPermissionService;
use App\Domain\Authorization\RolePermissions\Services\IRolePermissionService;
use App\Domain\Authorization\RolePermissions\Services\RolePermissionService;
use App\Domain\Authorization\Roles\Services\IRoleService;
use App\Domain\Authorization\Roles\Services\RoleService;
use App\Domain\Authorization\UserRoles\Services\IUserRoleService;
use App\Domain\Authorization\UserRoles\Services\UserRoleService;
use App\Domain\Catalog\Brands\Services\BrandService;
use App\Domain\Catalog\Brands\Services\IBrandService;
use App\Domain\Catalog\Categories\Services\CategoryService;
use App\Domain\Catalog\Categories\Services\ICategoryService;
use App\Domain\Catalog\ProductImages\Services\IProductImageService;
use App\Domain\Catalog\ProductImages\Services\ProductImageService;
use App\Domain\Catalog\Products\Services\IProductService;
use App\Domain\Catalog\Products\Services\ProductService;
use App\Domain\Catalog\ProductSizes\Services\IProductSizeService;
use App\Domain\Catalog\ProductSizes\Services\ProductSizeService;
use App\Domain\Catalog\SkinTypes\Services\ISkinTypeService;
use App\Domain\Catalog\SkinTypes\Services\SkinTypeService;
use App\Domain\Contacts\Services\ContactUsService;
use App\Domain\Contacts\Services\IContactUsService;
use App\Domain\Customers\Services\CustomerDomainService;
use App\Domain\Customers\Services\ICustomerDomainService;
use App\Domain\Design\Pages\Services\IPageService;
use App\Domain\Design\Pages\Services\PageService;
use App\Domain\Design\PageTemplates\Services\IPageTemplateService;
use App\Domain\Design\PageTemplates\Services\PageTemplateService;
use App\Domain\Design\Sliders\Services\ISliderService;
use App\Domain\Design\Sliders\Services\SliderService;
use App\Domain\Design\Templates\Services\ITemplateService;
use App\Domain\Design\Templates\Services\TemplateService;
use App\Domain\News\Services\INewsService;
use App\Domain\News\Services\NewsService;
use App\Domain\Posts\Services\IPostService;
use App\Domain\Posts\Services\PostService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ICustomerDomainService::class,CustomerDomainService::class);
        $this->app->bind(IPostService::class,PostService::class);
        $this->app->bind(IProductService::class,ProductService::class);
        $this->app->bind(IProductImageService::class,ProductImageService::class);
        $this->app->bind(IProductSizeService::class,ProductSizeService::class);
        $this->app->bind(ICategoryService::class,CategoryService::class);
        $this->app->bind(INewsService::class,NewsService::class);
        $this->app->bind(IBrandService::class,BrandService::class);
        $this->app->bind(ISkinTypeService::class,SkinTypeService::class);
        $this->app->bind(IPageService::class,PageService::class);
        $this->app->bind(ITemplateService::class,TemplateService::class);
        $this->app->bind(IPageTemplateService::class,PageTemplateService::class);
        $this->app->bind(IContactUsService::class,ContactUsService::class);
        $this->app->bind(ISliderService::class,SliderService::class);
        $this->app->bind(IRoleService::class,RoleService::class);
        $this->app->bind(IPermissionService::class,PermissionService::class);
        $this->app->bind(IRolePermissionService::class,RolePermissionService::class);
        $this->app->bind(IUserRoleService::class,UserRoleService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Product
        $this->loadMigrationsFrom('app/Domain/Catalog/Products/Migrations');
        $this->loadMigrationsFrom('app/Domain/Catalog/ProductImages/Migrations');
        $this->loadMigrationsFrom('app/Domain/Catalog/ProductSizes/Migrations');

        //Category
        $this->loadMigrationsFrom('app/Domain/Catalog/Categories/Migrations');

        //Brand
        $this->loadMigrationsFrom('app/Domain/Catalog/Brands/Migrations');

        //SkinType
        $this->loadMigrationsFrom('app/Domain/Catalog/SkinTypes/Migrations');

        //News
        $this->loadMigrationsFrom('app/Domain/News/Migrations');

        //Pages
        $this->loadMigrationsFrom('app/Domain/Design/Pages/Migrations');

        //Templates
        $this->loadMigrationsFrom('app/Domain/Design/Templates/Migrations');

        //PageTemplates
        $this->loadMigrationsFrom('app/Domain/Design/PageTemplates/Migrations');

        //ContactUs
        $this->loadMigrationsFrom('app/Domain/Contacts/Migrations');

        //Sliders
        $this->loadMigrationsFrom('app/Domain/Design/Sliders/Migrations');

        //Roles
        $this->loadMigrationsFrom('app/Domain/Authorization/Roles/Migrations');

        //Permissions
        $this->loadMigrationsFrom('app/Domain/Authorization/Permissions/Migrations');

        //RolePermissions
        $this->loadMigrationsFrom('app/Domain/Authorization/RolePermissions/Migrations');

        //UserRoles
        $this->loadMigrationsFrom('app/Domain/Authorization/UserRoles/Migrations');
    }
}

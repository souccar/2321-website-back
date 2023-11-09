<?php

use App\Domain\Authentication\Http\Controllers\AuthenticationController;
use App\Domain\Catalog\Brands\Http\Controllers\BrandController;
use App\Domain\Catalog\Categories\Http\Controllers\CategoryController;
use App\Domain\Catalog\ProductImages\Http\Controllers\ProductImageController;
use App\Domain\Catalog\Products\Http\Controllers\ProductController;
use App\Domain\Catalog\SkinTypes\Http\Controllers\SkinTypeController;
use App\Domain\Contacts\Http\Controllers\ContactUsController;
use App\Domain\Customers\Http\Controllers\CustomerController;
use App\Domain\Design\Pages\Http\Controllers\PageController;
use App\Domain\Design\PageTemplates\Http\Controllers\PageTemplateController;
use App\Domain\Design\Sliders\Http\Controllers\SliderController;
use App\Domain\Design\Templates\Http\Controllers\TemplateController;
use App\Domain\News\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// require_once('app/Domain/Catalog/Categories/Routes/category-routes.php');

//Customers
Route::get('/customers', [CustomerController::class, 'index']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::put('/customers/{id}', [CustomerController::class, 'edit']);
Route::delete('/customers/{id}', [CustomerController::class, 'delete']);

//News
Route::get('/news',[NewsController::class,'getAll']);
Route::get('/news/{id}',[NewsController::class,'getById']);
Route::get('/getOnlyForHome',[NewsController::class,'getOnlyForHome']);
Route::get('/lastNews',[NewsController::class,'getLastEightNews']);
Route::post('/news',[NewsController::class,'store']);
Route::post('/news/{id}',[NewsController::class,'edit']);
Route::delete('/news/{id}',[NewsController::class,'destroy']);

//Categories
Route::get('/categories',[CategoryController::class,'getAll']);
Route::get('/categories/{id}',[CategoryController::class,'getById']);
Route::post('/categories',[CategoryController::class,'store']);
Route::post('/categories/{id}',[CategoryController::class,'edit']);
Route::delete('/categories/{id}',[CategoryController::class,'destroy']);

//Brands
Route::get('/brands',[BrandController::class,'getAll']);
Route::get('/brands/{id}',[BrandController::class,'getById']);
Route::post('/brands',[BrandController::class,'store']);
Route::post('/brands/{id}',[BrandController::class,'edit']);
Route::delete('/brands/{id}',[BrandController::class,'destroy']);

//SkinTypes
Route::get('/skinTypes',[SkinTypeController::class,'getAll']);
Route::get('/skinTypes/{id}',[SkinTypeController::class,'getById']);
Route::post('/skinTypes',[SkinTypeController::class,'store']);
Route::post('/skinTypes/{id}',[SkinTypeController::class,'edit']);
Route::delete('/skinTypes/{id}',[SkinTypeController::class,'destroy']);

//Products
Route::get('/products',[ProductController::class,'getAll']);
Route::get('/products/{id}',[ProductController::class,'getById']);
Route::get('/productsByCategoryId',[ProductController::class,'getByCategoryId']);
Route::get('/productsByBrandId',[ProductController::class,'getByBrandId']);
Route::get('/productsBySkinTypeId',[ProductController::class,'getBySkinTypeId']);
Route::post('/products',[ProductController::class,'store']);
Route::post('/products/{id}',[ProductController::class,'edit']);
Route::delete('/products/{id}',[ProductController::class,'destroy']);
Route::post('/uploadProductImages',[ProductController::class,'uploadProductImages']);
Route::delete('/removeProductImages/{id}',[ProductImageController::class,'destroy']);

//Pages
Route::post('/pages',[PageController::class,'store']);
Route::post('/pages/{id}',[PageController::class,'edit']);
Route::delete('/pages/{id}',[PageController::class,'destroy']);
Route::post('/uploadPageImage',[PageController::class,'uploadPageImage']);
Route::get('/getPagesForDrobdown',[PageController::class,'getForDrobdown']);
Route::get('/getAllPages',[PageController::class,'getAll']);
Route::get('/getPageBySlug/{slug}',[PageController::class,'getPageBySlug']);
Route::get('/getForEdit/{id}',[PageController::class,'getForEdit']);
Route::get('/getAssociatedTemplates/{pageId}',[PageController::class,'getAssociatedTemplates']);

//Templates
Route::post('/templates',[TemplateController::class,'store']);
Route::post('/templates/{id}',[TemplateController::class,'edit']);
Route::delete('/templates/{id}',[TemplateController::class,'destroy']);
Route::post('/uploadTemplateImage',[TemplateController::class,'uploadTemplateImage']);
Route::get('/getTemplatesForDrobdown',[TemplateController::class,'getForDrobdown']);
Route::get('/getAllTemplates',[TemplateController::class,'getAll']);
Route::get('/getAllForPage',[TemplateController::class,'getAllForPage']);
Route::get('/getWithChildren',[TemplateController::class,'getWithChildren']);

//PageTamplates
Route::post('/pageTemplates',[PageTemplateController::class,'store']);
Route::post('/pageTemplates/{id}',[PageTemplateController::class,'edit']);
Route::delete('/pageTemplates/{id}',[PageTemplateController::class,'destroy']);


//ContactUs
Route::get('/allContacts',[ContactUsController::class,'getAll']);
Route::get('/contacts/{id}',[ContactUsController::class,'getById']);
Route::post('/contactUs',[ContactUsController::class,'store']);
Route::delete('/contacts/{id}',[ContactUsController::class,'destroy']);


//Slider
Route::post('/Sliders',[SliderController::class,'store']);
Route::post('/Sliders/{id}',[SliderController::class,'edit']);
Route::delete('/Sliders/{id}',[SliderController::class,'destroy']);
Route::post('/uploadSliderImage',[SliderController::class,'uploadSliderImage']);
Route::get('/getAllSliders',[SliderController::class,'getAll']);


//User
Route::get('users/{count}' ,[UserController::class,'GetAll']);
Route::get('user/{id}' ,[UserController::class,'getById']);
Route::post('/register',[UserController::class,'register']);
Route::put('/editUser/{id}',[UserController::class,'edit']);
Route::delete('/deleteUser/{id}',[UserController::class,'destroy']);


//Authentication
Route::post('login',[AuthenticationController::class,'login']);
Route::post('logout',[AuthenticationController::class,'logout']);


<?php

namespace App\Domain\Catalog\Products\Models;

use App\Domain\Catalog\Brands\Models\Brand;
use App\Domain\Catalog\Categories\Models\Category;
use App\Domain\Catalog\ProductImages\Models\ProductImage;
use App\Domain\Catalog\ProductSizes\Models\ProductSize;
use App\Domain\Catalog\SkinTypes\Models\SkinType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'point',
        'categoryId',
        'brandId',
        'skinTypeId',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at',
        'categoryId',
        'brandId',
        'skinTypeId',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    protected $guarded = [];

    
    /*
        Relations
    */

    public function category()
    {
        return $this->belongsTo(Category::class,'categoryId','id');
    }   

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brandId','id');
    } 

    public function skinType()
    {
        return $this->belongsTo(SkinType::class,'skinTypeId','id');
    } 

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class,'ProductId','id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class,'productId','id');
    }
}

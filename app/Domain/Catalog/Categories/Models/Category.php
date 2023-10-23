<?php

namespace App\Domain\Catalog\Categories\Models;

use App\Domain\Catalog\CategoryNews\Models\CategoryNews;
use App\Domain\Catalog\Products\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
        'point',
        'imagePath',
        'parentCategoryId'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at',
        'parentCategoryId'
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
        return $this->belongsTo(Category::class,'parentCategoryId','id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

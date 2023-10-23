<?php

namespace App\Domain\Catalog\ProductSizes\Models;

use App\Domain\Catalog\Products\Models\Product;
use App\Domain\Catalog\ProductSizes\ProductUnitEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSize extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'productSizes';

    protected $fillable = [
        'size',
        'unit',
        'ProductId'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at',
        'ProductId'
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

    // protected $casts = [
    //     'unit' => ProductUnitEnum::class
    // ];

    /*
        Relations
    */

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
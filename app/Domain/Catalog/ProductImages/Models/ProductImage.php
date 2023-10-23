<?php

namespace App\Domain\Catalog\ProductImages\Models;

use App\Domain\Catalog\Products\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'productImages';

    protected $fillable = [
        'imagePath',
        'productId'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at',
        'productId'
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

    public function product()
    {
        return $this->belongsTo(Product::class);
    } 
}

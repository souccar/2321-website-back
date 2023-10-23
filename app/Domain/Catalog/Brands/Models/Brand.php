<?php

namespace App\Domain\Catalog\Brands\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'brands';

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at',
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

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

<?php

namespace App\Domain\News\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'description',
        'imagePath',
        'displayInHome'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at'
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

    protected $appends = ['imageBase64'];


    public function getImageBase64Attribute()
    {
        if ($this->imagePath != null && file_exists(public_path($this->imagePath)))
        {
            $base64 = base64_encode(file_get_contents($this->imagePath));
            return $base64;
        }
        else{
            return null;
        }
    }

}

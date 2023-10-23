<?php

namespace App\Domain\Design\Pages\Models;

use App\Domain\Design\PageTemplates\Models\PageTemplate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'pages';

    protected $fillable = [
        'slug',
        'title',
        'description',
        'imagePath',
        'image_title',
        'image_description'
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

    public function PageTemplates()
    {
        return $this->hasMany(PageTemplate::class,'pageId','id');
    }
}

<?php

namespace App\Domain\Design\PageTemplates\Models;

use App\Domain\Design\Pages\Models\Page;
use App\Domain\Design\Templates\Models\Template;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageTemplate extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'page_templates';

    protected $fillable = [
        'pageId',
        'templateId',
        'order',
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

    public function page()
    {
        return $this->belongsTo(Page::class,'pageId','id');
    }

    public function template()
    {
        return $this->belongsTo(Template::class,'templateId','id');
    }
}

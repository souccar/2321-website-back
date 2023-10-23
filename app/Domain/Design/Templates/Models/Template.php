<?php

namespace App\Domain\Design\Templates\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'templates';

    protected $fillable = [
        'type',
        'title',
        'description',
        'imagePath',
        'videoPath',
        'link_title',
        'page_slug',
        'numberOfColumns',
        'parentTemplateId'
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

    public function childTemplates()
    {
        return $this->hasMany(Template::class,'parentTemplateId');
    }
    
    public function ParentTemplate()
    {
        return $this->belongsTo(Template::class,'parentTemplateId','id');
    }
}

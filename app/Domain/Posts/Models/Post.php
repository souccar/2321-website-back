<?php

namespace App\Domain\Posts\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
class Post extends Model
{
    use HasFactory,HasTranslations,SoftDeletes;
    protected $fillable = [
        'title',
        'descripiton',
        'subDescripiton',
        'slug',
        'linkTitle',
        'showInHomePage',
        'imagePath',
    ];
    public $translatable = ['title', 'descripiton','subDescripiton'];
}

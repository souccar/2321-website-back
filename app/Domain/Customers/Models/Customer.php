<?php

namespace App\Domain\Customers\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Customer extends Model
{
    use HasFactory,HasTranslations;
    protected $fillable = [
        'name',
        'mobile'
    ];
    public $translatable = ['name', 'mobile'];

}

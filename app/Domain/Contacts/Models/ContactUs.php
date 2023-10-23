<?php

namespace App\Domain\Contacts\Models;

use App\Domain\Contacts\Mail\Mail\ContactMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

class ContactUs extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'contacts';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
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

    // public static function boot() {  

    //     parent::boot();  

        
    //     static::created(function ($item) {                

    //         $adminEmail = "tomohamad37souccar@gmail.com";
    //         $data = array(
    //             'name'      =>  'ddddddd',
    //             'message'   =>   'eeeeeeeeeee'
    //         );

    //         Mail::to($adminEmail)->send(new ContactMail($data));

    //     });

    // }

}


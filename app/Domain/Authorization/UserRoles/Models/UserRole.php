<?php

namespace App\Domain\Authorization\UserRoles\Models;

use App\Domain\Authorization\Roles\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'user_roles';

    protected $fillable = [
        'userId',
        'roleId'
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

    public function User()
    {
        return $this->belongsTo(User::class,'userId','id');
    }

    public function Role()
    {
        return $this->belongsTo(Role::class,'roleId','id');
    }
}

<?php

namespace App\Domain\Authorization\Roles\Models;

use App\Domain\Authorization\RolePermissions\Models\RolePermission;
use App\Domain\Authorization\UserRoles\Models\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'roles';

    protected $fillable = [
        'name',
        'displayName'
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


    public function UserRoles()
    {
        return $this->hasMany(UserRole::class,'roleId','id');
    }

    public function RolePermissions()
    {
        return $this->hasMany(RolePermission::class,'roleId','id');
    }
}

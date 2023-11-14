<?php

namespace App\Domain\Authorization\RolePermissions\Models;

use App\Domain\Authorization\Permissions\Models\Permission;
use App\Domain\Authorization\Roles\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePermission extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'role_permissions';

    protected $fillable = [
        'roleId',
        'permissionId'
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

    
    public function Role()
    {
        return $this->belongsTo(Role::class,'roleId','id');
    }

    public function Permission()
    {
        return $this->belongsTo(Permission::class,'permissionId','id');
    }
}

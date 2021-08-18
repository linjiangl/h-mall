<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\Role;

use App\Model\Model;

/**
 * @property int $role_id
 * @property int $admin_id
 */
class RoleAdmin extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'role_admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['role_id', 'admin_id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['role_id' => 'integer', 'admin_id' => 'integer'];
}

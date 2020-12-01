<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model\Role;

use App\Model\Model;

/**
 * @property int $id
 * @property int $role_id
 * @property int $menu_id
 * @property int $created_at
 * @property int $updated_at
 */
class RoleMenu extends Model
{
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'role_menu';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'role_id', 'menu_id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'role_id' => 'integer', 'menu_id' => 'integer', 'created_at' => 'integer', 'updated_at' => 'integer'];
}

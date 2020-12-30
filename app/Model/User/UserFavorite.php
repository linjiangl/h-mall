<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\User;

use App\Model\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $module 模块 goods:商品, shop:店铺
 * @property int $module_id
 * @property int $created_time
 * @property int $updated_time
 */
class UserFavorite extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_favorite';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'module', 'module_id', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'module_id' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}

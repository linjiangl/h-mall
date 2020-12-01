<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model;

use Hyperf\Database\Model\SoftDeletes;

/**
 * @property int $id
 * @property int $shop_id 店铺 0:系统
 * @property int $type
 * @property string $qq
 * @property string $wechat
 * @property string $name
 * @property int $status 状态 -1:已删除, 0:已禁用, 1:已启用
 * @property string $remark 备注
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class CustomerService extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer_service';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'shop_id', 'type', 'qq', 'wechat', 'name', 'status', 'remark', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'shop_id' => 'integer', 'type' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}

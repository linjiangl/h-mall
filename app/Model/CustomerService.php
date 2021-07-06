<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model;

/**
 * @property int $id
 * @property int $shop_id 店铺 0:系统
 * @property int $type
 * @property string $qq
 * @property string $wechat
 * @property string $name
 * @property int $status 状态 0:已禁用, 1:已启用
 * @property string $remark 备注
 * @property int $created_time
 * @property int $updated_time
 */
class CustomerService extends Model
{
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
    protected $fillable = ['id', 'shop_id', 'type', 'qq', 'wechat', 'name', 'status', 'remark', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'shop_id' => 'integer', 'type' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}

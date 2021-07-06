<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\Shop;

use App\Model\Model;

/**
 * @property int $id
 * @property int $shop_id
 * @property int $user_id
 * @property string $amount
 * @property int $refused_time 拒绝时间
 * @property int $finished_time 完成时间
 * @property int $status 状态 -1:已删除
 * @property string $remark
 * @property int $created_time
 * @property int $updated_time
 * @property int $deleted_time
 */
class ShopWithdraw extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shop_withdraw';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'shop_id', 'user_id', 'amount', 'refused_time', 'finished_time', 'status', 'remark', 'created_time', 'updated_time', 'deleted_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'shop_id' => 'integer', 'user_id' => 'integer', 'refused_time' => 'integer', 'finished_time' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer', 'deleted_time' => 'integer'];
}

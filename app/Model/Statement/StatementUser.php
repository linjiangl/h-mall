<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\Statement;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $type 类型 recharged:充值 consumed:消费
 * @property float $amount 金额
 * @property int $integral 积分
 * @property string $description 描述
 * @property string $module 模块 order:订单
 * @property int $module_id
 * @property string $remark
 * @property int $created_time
 * @property int $updated_time
 */
class StatementUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'statement_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'type', 'amount', 'integral', 'description', 'module', 'module_id', 'remark', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'amount' => 'float', 'integral' => 'integer', 'module_id' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}

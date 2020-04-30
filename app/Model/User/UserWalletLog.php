<?php

declare (strict_types=1);
namespace App\Model\User;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id 
 * @property int $user_id 
 * @property string $type 类型 recharged:充值 consumed:消费
 * @property float $amount 金额
 * @property int $integral 积分
 * @property float $red_packet 红包
 * @property string $intro 简介
 * @property string $module 模块 order:订单
 * @property int $module_id 
 * @property string $remark 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $deleted_at 
 */
class UserWalletLog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_wallet_log';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'int', 'user_id' => 'integer', 'amount' => 'float', 'integral' => 'integer', 'red_packet' => 'float', 'module_id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
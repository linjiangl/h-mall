<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model\User;

use App\Model\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $serial_no 会员卡号
 * @property int $grade 会员等级
 * @property int $total_exp 总经验
 * @property int $current_exp 当前经验
 * @property string $real_name 真实姓名
 * @property string $mobile 手机号码
 * @property string $id_card 身份证号码
 * @property string $password 会员卡密码
 * @property int $status 状态 -1:已删除, 0:未激活, 1:已激活
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class UserVipCard extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_vip_card';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'serial_no', 'grade', 'total_exp', 'current_exp', 'real_name', 'mobile', 'id_card', 'password', 'status', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'grade' => 'integer', 'total_exp' => 'integer', 'current_exp' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}

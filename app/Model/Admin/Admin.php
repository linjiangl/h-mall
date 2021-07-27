<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\Admin;

use App\Model\Model;

/**
 * @property int $id
 * @property int $shop_id 门店 0:管理员账号
 * @property string $username 用户名
 * @property string $avatar 头像
 * @property string $real_name 姓名
 * @property string $mobile 手机号
 * @property string $email 邮箱
 * @property string $password
 * @property string $salt
 * @property int $status 状态 0:禁用, 1:启用
 * @property int $lasted_login_time 最后登录时间
 * @property int $created_time
 * @property int $updated_time
 */
class Admin extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'shop_id', 'username', 'avatar', 'real_name', 'mobile', 'email', 'password', 'salt', 'status', 'lasted_login_time', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'shop_id' => 'integer', 'status' => 'integer', 'lasted_login_time' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];

    protected $hidden = ['password', 'salt'];
}

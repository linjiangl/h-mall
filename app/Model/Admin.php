<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property string $username 用户名
 * @property string $avatar 头像
 * @property string $real_name 姓名
 * @property string $mobile 手机号
 * @property string $email 邮箱
 * @property string $password
 * @property string $salt
 * @property int $status 状态
 * @property string $lasted_login_at 最后登录时间
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
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
    protected $fillable = ['id', 'username', 'avatar', 'real_name', 'mobile', 'email', 'password', 'salt', 'status', 'lasted_login_at', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    protected $hidden = ['password', 'salt', 'mobile', 'email'];
}

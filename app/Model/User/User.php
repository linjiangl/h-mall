<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Model\User;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property string $username 用户名
 * @property string $nickname 昵称
 * @property string $mobile 手机
 * @property string $avatar 头像
 * @property int $sex 性别 1:男, 2:女, 3:保密
 * @property string $email 邮箱
 * @property string $password 密码
 * @property string $remember_token
 * @property string $salt 加密盐
 * @property int $status 状态 1:正常, 2:禁用
 * @property string $lasted_login_at 最后登录时间
 * @property string $mobile_verified_at 手机验证时间
 * @property string $email_verified_at 邮箱验证时间
 * @property string $avatar_updated_at 头像设置时间
 * @property string $username_updated_at 用户名设置时间
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Model\User\UserVipCard $vipCard
 * @property-read \App\Model\User\UserWallet $wallet
 */
class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'username', 'nickname', 'mobile', 'avatar', 'sex', 'email', 'password', 'remember_token', 'salt', 'status', 'lasted_login_at', 'mobile_verified_at', 'email_verified_at', 'avatar_updated_at', 'username_updated_at', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'sex' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    protected $hidden = ['password', 'salt', 'mobile', 'email', 'mobile_verified_at', 'email_verified_at', 'avatar_updated_at', 'username_updated_at'];

    public function vipCard()
    {
        return $this->hasOne(UserVipCard::class, 'user_id', 'id');
    }

    public function wallet()
    {
        return $this->hasOne(UserWallet::class, 'user_id', 'id');
    }
}

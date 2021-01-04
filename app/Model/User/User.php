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

use App\Constants\State\User\UserState;
use App\Model\Model;

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
 * @property int $status 状态 -1:已删除, 0:已禁用, 1:已启用, 2:待审核
 * @property int $is_system 是否系统用户
 * @property int $lasted_login_time 最后登录时间
 * @property int $mobile_verified_time 手机验证时间
 * @property int $email_verified_time 邮箱验证时间
 * @property int $avatar_updated_time 头像设置时间
 * @property int $username_updated_time 用户名设置时间
 * @property int $created_time
 * @property int $updated_time
 * @property-read \Hyperf\Database\Model\Collection|\App\Model\User\UserAddress[] $address
 * @property-read  $appends
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
    protected $fillable = ['id', 'username', 'nickname', 'mobile', 'avatar', 'sex', 'email', 'password', 'remember_token', 'salt', 'status', 'is_system', 'lasted_login_time', 'mobile_verified_time', 'email_verified_time', 'avatar_updated_time', 'username_updated_time', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'sex' => 'integer', 'status' => 'integer', 'is_system' => 'integer', 'lasted_login_time' => 'integer', 'mobile_verified_time' => 'integer', 'email_verified_time' => 'integer', 'avatar_updated_time' => 'integer', 'username_updated_time' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];

    protected $hidden = ['password', 'salt', 'mobile', 'email', 'is_system', 'mobile_verified_at', 'email_verified_at', 'avatar_updated_at', 'username_updated_at'];

    protected $appends = ['appends'];

    public function getAppendsAttribute() : array
    {
        return UserState::handleMessages(['status' => $this->status]);
    }

    public function vipCard()
    {
        return $this->hasOne(UserVipCard::class);
    }

    public function wallet()
    {
        return $this->hasOne(UserWallet::class);
    }

    public function address()
    {
        return $this->hasMany(UserAddress::class);
    }
}

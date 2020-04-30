<?php

declare (strict_types=1);
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
 * @property string $salt 加密盐
 * @property int $status 状态 1:正常, 2:禁用
 * @property int $role 角色 0:普通用户 1:管理员
 * @property string $lasted_login_at 最后登录时间
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
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
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'int', 'sex' => 'integer', 'status' => 'integer', 'role' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
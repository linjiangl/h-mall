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
 * @property int $admin_id
 * @property string $username 管理员用户名
 * @property string $client_ip
 * @property string $user_agent
 * @property int $status 状态 -1:已删除
 * @property int $created_time
 * @property int $updated_time
 */
class AdminLogin extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'log_admin_login';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'admin_id', 'username', 'client_ip', 'user_agent', 'status', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'admin_id' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}

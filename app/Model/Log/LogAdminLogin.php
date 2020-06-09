<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Model\Log;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property string $username 管理员用户名
 * @property string $client_ip
 * @property string $user_agent
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class LogAdminLogin extends Model
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
    protected $fillable = ['id', 'username', 'client_ip', 'user_agent', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}

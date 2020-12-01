<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model\Log;

use App\Model\Model;
use Hyperf\Database\Model\SoftDeletes;

/**
 * @property int $id
 * @property int $admin_id
 * @property string $username 管理员用户名
 * @property string $client_ip
 * @property string $user_agent
 * @property int $status 状态 -1:已删除
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class LogAdminLogin extends Model
{
    use SoftDeletes;

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
    protected $fillable = ['id', 'admin_id', 'username', 'client_ip', 'user_agent', 'status', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'admin_id' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}

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
 * @property string $module
 * @property string $action
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property string $remark
 */
class LogAdminAction extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'log_admin_action';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'admin_id', 'username', 'client_ip', 'module', 'action', 'remark', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'admin_id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    public function getRemarkAttribute($value)
    {
        return $value ? json_decode($value, true) : '';
    }

    public function setRemarkAttribute($value)
    {
        $this->attributes['remark'] = $value ? json_encode($value, JSON_UNESCAPED_UNICODE) : '';
    }
}

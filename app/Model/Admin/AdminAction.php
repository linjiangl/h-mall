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
 * @property string $module
 * @property string $action
 * @property int $status 状态 -1:已删除
 * @property int $created_time
 * @property int $updated_time
 * @property  $remark
 */
class AdminAction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_action';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'admin_id', 'username', 'client_ip', 'module', 'action', 'status', 'remark', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'admin_id' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];

    public function getRemarkAttribute($value)
    {
        return $value ? json_decode($value, true) : '';
    }

    public function setRemarkAttribute($value)
    {
        $this->attributes['remark'] = $value ? json_encode($value, JSON_UNESCAPED_UNICODE) : '';
    }
}

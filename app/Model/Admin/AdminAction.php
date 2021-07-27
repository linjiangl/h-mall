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
 * @property int $created_time
 * @property int $updated_time
 * @property int $deleted_time
 * @property array $remark
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
    protected $fillable = ['id', 'admin_id', 'username', 'client_ip', 'module', 'action', 'remark', 'created_time', 'updated_time', 'deleted_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'admin_id' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer', 'deleted_time' => 'integer'];

    public function getRemarkAttribute($value): array
    {
        return database_text($value, 'de');
    }

    public function setRemarkAttribute($value)
    {
        $this->attributes['remark'] = database_text($value);
    }
}

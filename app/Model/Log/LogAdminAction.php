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
 * @property int $admin_id
 * @property string $client_ip
 * @property string $action
 * @property string $method
 * @property string $url
 * @property string $header
 * @property string $query
 * @property string $request
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class LogAdminAction extends Model
{
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
    protected $fillable = ['id', 'admin_id', 'client_ip', 'action', 'method', 'url', 'header', 'query', 'request', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'admin_id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}

<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

namespace App\Model\Entity;

use Hyperf\DbConnection\Model\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property string $deleted_at
 * @property int $id
 * @property int $send_id
 * @property int $status
 * @property string $target
 * @property int $target_id
 * @property string $target_url
 * @property int $to_id
 * @property string $type
 * @property \Carbon\Carbon $updated_at
 */
class Message extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'message';

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
    protected $casts = ['created_at' => 'datetime', 'id' => 'int', 'send_id' => 'integer', 'status' => 'integer', 'target_id' => 'integer', 'to_id' => 'integer', 'updated_at' => 'datetime'];
}

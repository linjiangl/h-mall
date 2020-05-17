<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace  App\Model\Message;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $user_id
 * @property string $setting
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class MessageSubscription extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'message_subscription';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'setting', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['user_id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}

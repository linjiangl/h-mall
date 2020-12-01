<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model\User;

use App\Model\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $created_time
 * @property int $updated_time
 */
class UserHistory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'product_id', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'product_id' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}

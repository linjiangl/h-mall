<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model;

/**
 * @property int $id
 * @property string $module 模块 product:商品, shop:店铺
 * @property string $content
 * @property int $created_time
 * @property int $updated_time
 */
class Text extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'text';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'module', 'content', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}

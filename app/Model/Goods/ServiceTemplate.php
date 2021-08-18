<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\Goods;

use App\Model\Model;

/**
 * @property int $id
 * @property string $name 名称
 * @property string $description 描述
 * @property int $sorting 排序
 * @property int $created_time
 * @property int $updated_time
 */
class ServiceTemplate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'service_template';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'description', 'sorting', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'sorting' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}

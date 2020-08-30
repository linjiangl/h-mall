<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model\Spec;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $shop_id 店铺id 0:系统
 * @property string $name 名称
 * @property int $sorting 排序
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */
class Spec extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spec';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'shop_id', 'name', 'sorting', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'shop_id' => 'integer', 'sorting' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    public function values()
    {
        return $this->hasMany(SpecValue::class)->orderBy('sorting', 'asc');
    }
}

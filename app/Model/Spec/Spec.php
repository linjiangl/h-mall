<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\Spec;

use App\Model\Model;
use function Symfony\Component\String\s;

/**
 * @property int $id
 * @property int $shop_id 店铺id 0:系统
 * @property string $name 名称
 * @property int $sorting 排序
 * @property int $status 状态 -1:已删除, 0:已禁用, 1:已启用
 * @property int $created_time
 * @property int $updated_time
 * @property-read \Hyperf\Database\Model\Collection|\App\Model\Spec\SpecValue[] $values
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
    protected $fillable = ['id', 'shop_id', 'name', 'sorting', 'status', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'shop_id' => 'integer', 'sorting' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];

    public function values()
    {
        return $this->hasMany(SpecValue::class)->orderByRaw($this->orderByToSorting);
    }
}

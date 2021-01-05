<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\Parameter;

use App\Model\Model;

/**
 * @property int $id
 * @property int $parameter_id
 * @property string $option 选项名称
 * @property string $values 选项值
 * @property int $type 类型 0:单选,1:多选,2:输入
 * @property int $sorting 排序
 * @property int $created_time
 * @property int $updated_time
 */
class ParameterOption extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'parameter_options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'parameter_id', 'option', 'values', 'type', 'sorting', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'parameter_id' => 'integer', 'type' => 'integer', 'sorting' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}

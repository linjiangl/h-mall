<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model;

/**
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property int $created_time
 * @property int $updated_time
 */
class District extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'district';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'parent_id', 'name', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'parent_id' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}

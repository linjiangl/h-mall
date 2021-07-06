<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\User;

use App\Model\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name 姓名
 * @property string $mobile 手机号
 * @property int $province_id
 * @property string $province 省
 * @property int $city_id
 * @property string $city 市
 * @property int $district_id
 * @property string $district 区
 * @property int $street_id
 * @property string $street 街道
 * @property string $address 地址
 * @property string $zip_code 邮政编码
 * @property int $is_default 是否默认 0:否, 1:是
 * @property int $created_time
 * @property int $updated_time
 * @property-read User $user
 */
class UserAddress extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_address';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'name', 'mobile', 'province_id', 'province', 'city_id', 'city', 'district_id', 'district', 'street_id', 'street', 'address', 'zip_code', 'is_default', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'province_id' => 'integer', 'city_id' => 'integer', 'district_id' => 'integer', 'street_id' => 'integer', 'is_default' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

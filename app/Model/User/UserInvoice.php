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
 * @property int $shop_id
 * @property int $open_type 开具类型 0:个人 1:企业
 * @property int $type 发票类型 0:增值税普通发票 1:增值税专用发票 2:组织(非企业)增值税普通发票
 * @property string $title 发票抬头
 * @property string $taxpayer_no 纳税人识别号
 * @property string $register_address 注册地址
 * @property string $register_phone 注册电话
 * @property string $bank_name 开户银行
 * @property string $bank_account 银行账号
 * @property int $content_type 发票内容 0:商品明细
 * @property string $email 邮箱
 * @property int $status 状态 -1:已删除, 0:已禁用, 1:已启用
 * @property int $created_time
 * @property int $updated_time
 */
class UserInvoice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_invoice';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'shop_id', 'open_type', 'type', 'title', 'taxpayer_no', 'register_address', 'register_phone', 'bank_name', 'bank_account', 'content_type', 'email', 'status', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'shop_id' => 'integer', 'open_type' => 'integer', 'type' => 'integer', 'content_type' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}

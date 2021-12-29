<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Refund;

use App\Core\Dao\AbstractDao;
use App\Model\Refund\RefundProducts;
use Hyperf\Database\Model\Model;

class RefundGoodsDao extends AbstractDao
{
    protected string|Model $model = RefundProducts::class;

    protected string $notFoundMessage = '退款的商品不存在';
}

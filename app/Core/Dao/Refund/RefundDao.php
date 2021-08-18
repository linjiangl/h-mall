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
use App\Model\Refund\Refund;
use Hyperf\Database\Model\Model;

class RefundDao extends AbstractDao
{
    protected string|Model $model = Refund::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '退款订单不存在';
}

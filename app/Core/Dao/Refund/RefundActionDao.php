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
use App\Model\Refund\RefundAction;
use Hyperf\Database\Model\Model;

class RefundActionDao extends AbstractDao
{
    protected string|Model $model = RefundAction::class;

    protected string $notFoundMessage = '退款操作不存在';
}

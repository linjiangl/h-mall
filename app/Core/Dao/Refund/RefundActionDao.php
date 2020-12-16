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

class RefundActionDao extends AbstractDao
{
    protected string $model = RefundAction::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '退款操作不存在';
}

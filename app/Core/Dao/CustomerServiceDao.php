<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao;

use App\Model\CustomerService;

class CustomerServiceDao extends AbstractDao
{
    protected string $model = CustomerService::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '客服不存在或已删除';
}

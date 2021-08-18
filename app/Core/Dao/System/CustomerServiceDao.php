<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\System;

use App\Core\Dao\AbstractDao;
use App\Model\CustomerService;
use Hyperf\Database\Model\Model;

class CustomerServiceDao extends AbstractDao
{
    protected string|Model $model = CustomerService::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '客服不存在或已删除';
}

<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao;

use App\Model\CustomerService;

class CustomerServiceDao extends AbstractDao
{
    protected $model = CustomerService::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '客服不存在或已删除';
}

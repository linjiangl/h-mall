<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\User;

use App\Core\Dao\AbstractDao;
use App\Model\User\UserInvoice;

class UserInvoiceDao extends AbstractDao
{
    protected string $model = UserInvoice::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '发票未创建或已删除';
}

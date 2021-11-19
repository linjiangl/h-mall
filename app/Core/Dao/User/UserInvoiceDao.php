<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\User;

use App\Core\Dao\AbstractDao;
use App\Model\User\UserInvoice;
use Hyperf\Database\Model\Model;

class UserInvoiceDao extends AbstractDao
{
    protected string|Model $model = UserInvoice::class;

    protected string $notFoundMessage = '发票未创建或已删除';
}

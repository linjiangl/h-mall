<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Shop;

use App\Core\Dao\AbstractDao;
use App\Model\Shop\ShopWithdraw;
use Hyperf\Database\Model\Model;

class ShopWithdrawDao extends AbstractDao
{
    protected string|Model $model = ShopWithdraw::class;

    protected string $notFoundMessage = '提现记录不存在';
}

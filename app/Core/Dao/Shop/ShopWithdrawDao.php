<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Shop;

use App\Core\Dao\AbstractDao;
use App\Model\Shop\ShopWithdraw;

class ShopWithdrawDao extends AbstractDao
{
    protected string $model = ShopWithdraw::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '提现记录不存在';
}

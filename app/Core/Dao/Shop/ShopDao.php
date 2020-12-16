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
use App\Model\Shop\Shop;

class ShopDao extends AbstractDao
{
    protected string $model = Shop::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '店铺不存在或已删除';
}

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
use Hyperf\Database\Model\Model;

class ShopDao extends AbstractDao
{
    protected string|Model $model = Shop::class;

    protected string $notFoundMessage = '店铺不存在或已删除';
}

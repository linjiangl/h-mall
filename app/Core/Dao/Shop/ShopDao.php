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
use App\Model\Shop\Shop;

class ShopDao extends AbstractDao
{
    protected $model = Shop::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '店铺不存在或已删除';
}

<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Product;

use App\Core\Dao\AbstractDao;
use App\Model\Product\ProductOption;

class ProductOptionDao extends AbstractDao
{
    protected $model = ProductOption::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '商品规格不存在或已删除';
}

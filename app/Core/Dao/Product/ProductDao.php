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
use App\Model\Product\Product;

class ProductDao extends AbstractDao
{
    protected $model = Product::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '商品不存在或已删除';
}

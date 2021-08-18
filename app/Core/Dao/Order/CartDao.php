<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Order;

use App\Core\Dao\AbstractDao;
use App\Model\Cart;
use Hyperf\Database\Model\Model;

class CartDao extends AbstractDao
{
    protected string|Model $model = Cart::class;

    protected array $noAllowActions = [];

    public function firstOrCreate(array $attributes, array $values): Cart
    {
        return parent::firstOrCreate($attributes, $values);
    }

    public function getInfoByCondition(array $condition = [], array $with = [], string $select = '*'): Cart
    {
        return parent::getInfoByCondition($condition, $with, $select);
    }
}

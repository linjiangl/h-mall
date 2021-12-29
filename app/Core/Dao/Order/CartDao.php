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
use App\Core\Service\Order\CartService;
use App\Model\Cart;
use Hyperf\Database\Model\Model;
use Hyperf\Database\Model\Relations\Relation;

class CartDao extends AbstractDao
{
    protected string|Model $model = Cart::class;

    /**
     * 获取或创建购物车.
     */
    public function firstOrCreate(array $attributes, array $values): Cart
    {
        return parent::firstOrCreate($attributes, $values);
    }

    public function getInfoByCondition(array $condition = [], array $with = [], string $select = '*'): Cart
    {
        return parent::getInfoByCondition($condition, $with, $select);
    }

    public function setMapWith(): static
    {
        $this->mapWith = [
            $this->buildMapWithKey('getCart', CartService::class) => ['shop', 'productSku', 'productSku.product', 'productSku.specValues', 'productSku.specValues.parent'],
            $this->buildMapWithKey('settlement', CartService::class) => [
                'shop' => function (Relation $query) {
                    $query->select(['id', 'name', 'logo', 'comment_score', 'status']);
                },
                'productSku', 'productSku.product', 'productSku.specValues', 'productSku.specValues.parent',
            ],
        ];
        return parent::setMapWith();
    }
}

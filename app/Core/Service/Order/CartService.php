<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Order;

use App\Constants\State\Order\CartState;
use App\Core\Dao\Goods\GoodsSkuDao;
use App\Core\Dao\Order\CartDao;
use App\Core\Service\AbstractService;
use App\Core\Service\Goods\Stock\Change\StockCartService;
use App\Core\Service\Goods\Stock\StockChangeService;
use Exception;

class CartService extends AbstractService
{
    protected string $dao = CartDao::class;

    /**
     * 添加购物车.
     */
    public function add(array $user, int $skuId, int $quantity = 1, array $append = []): int
    {
        $sku = (new GoodsSkuDao())->info($skuId);
        $data = [
            'goods_id' => $sku->goods_id,
            'quantity' => $quantity,
        ];
        if (! empty($append)) {
            $data = array_merge($data, $append);
        }

        // 创建购物车
        $cart = (new CartDao())->firstOrCreate([
            'user_id' => $user['id'],
            'goods_sku_id' => $sku->id,
        ], $data);

        /** @var StockCartService $stockChangeService */
        $stockChangeService = new StockChangeService(StockChangeService::STOCK_CART);
        if ($cart->wasRecentlyCreated) {
            // 创建占用库存
            $tmpCart = $cart->toArray();
            $tmpCart['sku'] = $sku->toArray();
            $stockChangeService->setAppend(['cart' => $tmpCart])->created($user, $cart->id, '添加购物车');
        } else {
            // 购物车商品已存在，增加占用库存数量
            $data['quantity'] = $cart->quantity + $quantity;
            $cart->update($data);

            $tmpCart = $cart->toArray();
            $tmpCart['sku'] = $sku->toArray();
            $stockChangeService->setAppend(['cart' => $tmpCart])->updated($user, $cart->id, '修改购物车');
        }
        return $cart->id;
    }

    /**
     * 修改购物车.
     */
    public function modify(array $user, int $cartId, int $quantity = 1, array $append = []): array
    {
        $cart = (new CartDao())->getInfoByCondition([
            ['id', '=', $cartId],
            ['user_id', '=', $user['id']],
        ]);

        $data = [
            'quantity' => $quantity,
        ];
        if (! empty($append)) {
            $data = array_merge($data, $append);
        }
        // 修改购物车商品数量
        $cart->update($data);

        // 修改后的购物车商品数量
        $tmpCart = $cart->toArray();
        $tmpCart['sku'] = $cart->sku->toArray();

        // 修改占用库存
        /** @var StockCartService $stockChangeService */
        $stockChangeService = new StockChangeService(StockChangeService::STOCK_CART);
        $stockChangeService->setAppend(['cart' => $tmpCart])->updated($user, $cart->id, '修改购物车');

        return $cart->toArray();
    }

    /**
     * 删除购物车商品.
     * @throws Exception
     */
    public function delete(array $user, int $cartId): bool
    {
        $cart = (new CartDao())->getInfoByCondition([
            ['id', '=', $cartId],
            ['user_id', '=', $user['id']],
        ]);

        // 恢复占用库存
        /** @var StockCartService $stockChangeService */
        $stockChangeService = new StockChangeService(StockChangeService::STOCK_CART);
        $stockChangeService->recovery($user, $cart->id);

        // 删除购物车商品
        $cart->delete();

        return true;
    }

    /**
     * 清空购物车商品
     */
    public function clear(array $user): bool
    {
        $condition = [['user_id', '=', $user['id']], ['is_show', '=', CartState::IS_SHOW_TRUE]];
        $dao = new CartDao();
        $cartList = $dao->getListByCondition($condition);

        // 恢复占用库存
        /** @var StockCartService $stockChangeService */
        $stockChangeService = new StockChangeService(StockChangeService::STOCK_CART);
        foreach ($cartList as $item) {
            $stockChangeService->recovery($user, $item['id']);
        }

        // 删除购物车商品
        $dao->deleteByCondition($condition);

        return true;
    }
}

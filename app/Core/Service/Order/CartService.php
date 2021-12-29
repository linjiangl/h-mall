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
use App\Core\Dao\Order\CartDao;
use App\Core\Dao\Product\ProductSkuDao;
use App\Core\Service\AbstractService;
use App\Core\Service\Product\Stock\Change\StockCartService;
use App\Core\Service\Product\Stock\StockChangeService;
use App\Exception\BadRequestException;
use App\Model\Cart;
use Exception;
use Hyperf\DbConnection\Db;

class CartService extends AbstractService
{
    protected string $dao = CartDao::class;

    /**
     * 获取购车信息.
     */
    public function getCart(): array
    {
        $user = $this->authorize;
        $dao = new CartDao();

        return $dao->getListByCondition([
            'user_id' => $user['user_id'],
            'is_buy_now' => CartState::IS_BUY_NOW_TRUE,
        ], $dao->setMapWith()->getMapWith('getCart', self::class));
    }

    /**
     * 统计购物车商品数量.
     */
    public function countCart(): int
    {
        $user = $this->authorize;
        $dao = new CartDao();

        return $dao->getCountByCondition([
            'user_id' => $user['user_id'],
            'is_buy_now' => CartState::IS_BUY_NOW_TRUE,
        ]);
    }

    /**
     * 添加购物车.
     */
    public function addCart(int $skuId, int $quantity = 1, array $append = []): Cart
    {
        $user = $this->authorize;
        $sku = (new ProductSkuDao())->info($skuId);
        $data = [
            'shop_id' => $sku->shop_id,
            'product_id' => $sku->product_id,
            'quantity' => $quantity,
        ];
        if (! empty($append)) {
            $data = array_merge($data, $append);
        }

        Db::beginTransaction();
        try {
            // 创建购物车
            $cart = (new CartDao())->firstOrCreate([
                'user_id' => $user['user_id'],
                'product_sku_id' => $sku->id,
            ], $data);

            /* @var StockCartService $stockChangeService */
            $stockChangeService = (new StockChangeService(StockChangeService::STOCK_CART))->getInstance();
            if ($cart->wasRecentlyCreated) {
                // 创建占用库存
                $tempCart = $cart->toArray();
                $tempCart['sku'] = $sku->toArray();

                $stockChangeService->setParams(['cart' => $tempCart])->created($user, $cart->id, '添加购物车');
            } else {
                // 购物车商品已存在，增加占用库存数量
                $data['quantity'] = $cart->quantity + $quantity;
                $cart->update($data);

                $tempCart = $cart->toArray();
                $tempCart['sku'] = $sku->toArray();

                $stockChangeService->setParams(['cart' => $tempCart])->updated($user, $cart->id, '修改购物车');
            }

            Db::commit();
            return $cart;
        } catch (Exception $e) {
            Db::rollBack();
            throw new BadRequestException($e->getMessage());
        }
    }

    /**
     * 修改购物车.
     */
    public function updateCart(int $cartId, int $quantity = 1, array $append = []): Cart
    {
        $user = $this->authorize;
        $cart = (new CartDao())->getInfoByCondition([
            ['id', '=', $cartId],
            ['user_id', '=', $user['user_id']],
        ]);

        $data = [
            'quantity' => $quantity,
        ];
        if (! empty($append)) {
            $data = array_merge($data, $append);
        }

        Db::beginTransaction();
        try {
            // 修改购物车商品数量
            $cart->update($data);

            // 修改后的购物车商品数量
            $tempCart = $cart->toArray();
            $tempCart['sku'] = $cart->sku->toArray();

            // 修改占用库存
            /* @var StockCartService $stockChangeService */
            $stockChangeService = (new StockChangeService(StockChangeService::STOCK_CART))->getInstance();
            $stockChangeService->setParams(['cart' => $tempCart])->updated($user, $cart->id, '修改购物车');

            Db::commit();
            return $cart;
        } catch (Exception $e) {
            Db::rollBack();
            throw new BadRequestException($e->getMessage());
        }
    }

    /**
     * 删除购物车商品.
     */
    public function deleteCart(int $cartId): bool
    {
        $user = $this->authorize;
        $cart = (new CartDao())->getInfoByCondition([
            ['id', '=', $cartId],
            ['user_id', '=', $user['user_id']],
        ]);

        Db::beginTransaction();
        try {
            // 恢复占用库存
            /* @var StockCartService $stockChangeService */
            $stockChangeService = (new StockChangeService(StockChangeService::STOCK_CART))->getInstance();
            $stockChangeService->recovery($user, $cart->id);

            // 删除购物车商品
            $cart->delete();

            Db::commit();
            return true;
        } catch (Exception $e) {
            Db::rollBack();
            throw new BadRequestException($e->getMessage());
        }
    }

    /**
     * 清空购物车商品
     */
    public function clearCart(): bool
    {
        $user = $this->authorize;
        $condition = [
            'user_id' => $user['user_id'],
            'is_buy_now' => CartState::IS_BUY_NOW_TRUE,
        ];
        $dao = new CartDao();
        $cartList = $dao->getListByCondition($condition);

        Db::beginTransaction();
        try {
            // 恢复占用库存
            /* @var StockCartService $stockChangeService */
            $stockChangeService = (new StockChangeService(StockChangeService::STOCK_CART))->getInstance();
            foreach ($cartList as $item) {
                $stockChangeService->recovery($user, $item['id']);
            }

            // 删除购物车商品
            $dao->deleteByCondition($condition);

            Db::commit();
            return true;
        } catch (Exception $e) {
            Db::rollBack();
            throw new BadRequestException($e->getMessage());
        }
    }

    /**
     * 获取选中的购物车信息.
     */
    public function settlement(): array
    {
        $user = $this->authorize;
        $dao = new CartDao();
        $list = $dao->getListByCondition([
            'user_id' => $user['user_id'],
            'is_check' => CartState::IS_CHECK_TRUE,
            'is_buy_now' => CartState::IS_BUY_NOW_FALSE,
        ], $dao->setMapWith()->getMapWith('settlement', self::class));

        $result = [];
        foreach ($list as $item) {
            if (! isset($result[$item['shop_id']])) {
                $result[$item['shop_id']] = $item['shop'];
            }
            $item['product_sku']['quantity'] = $item['quantity'];

            unset($item['shop']);
            $result[$item['shop_id']]['cart_list'][] = $item;
        }

        return array_values($result);
    }
}

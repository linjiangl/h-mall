<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Goods\Types;

use App\Constants\State\Goods\GoodsState;
use App\Core\Dao\Goods\GoodsDao;
use App\Exception\BadRequestException;
use Hyperf\DbConnection\Db;
use Throwable;

abstract class AbstractTypesService implements InterfaceTypesService
{
    /**
     * 商品id.
     */
    protected int $goodsId = 0;

    /**
     * 商品数据.
     */
    protected array $goods = [];

    public function __construct(array $data, int $id = 0)
    {
        $this->goodsId = $id;
        $this->goods = $data;
    }

    public function create(): int
    {
        Db::beginTransaction();
        try {
            // 创建商品
            $data = $this->handleGoodsData();
            $goodsDao = new GoodsDao();
            $id = $goodsDao->create($data);

            // 关联规格
            $goods = $goodsDao->info($id);
            if (isset($data['option_ids']) && count($data['option_ids']) > 0) {
                $goods->specs()->sync($data['option_ids']);
            }

            Db::commit();
            return $id;
        } catch (Throwable $e) {
            Db::rollBack();
            throw new BadRequestException($e->getMessage());
        }
    }

    public function update(): array
    {
        $goodsDao = new GoodsDao();
        return $goodsDao->update($this->goodsId, $this->goods);
    }

    protected function handleGoodsData(): array
    {
        $sku = $this->goods['sku'];
        $skuPrice = array_column($sku, 'price');
        sort($skuPrice);
        $minPrice = $skuPrice[0];
        $maxPrice = end($skuPrice);

        if ($this->goods['images'] && is_array($this->goods['images'])) {
            $this->goods['images'] = implode(',', $this->goods['images']);
        }

        return [
            'shop_id' => $this->goods['shop_id'],
            'title' => $this->goods['title'],
            'sub_title' => $this->goods['sub_title'],
            'images' => $this->goods['images'],
            'description_id' => $this->goods['description_id'] ?? 0,
            'shipping_required' => $this->goods['shipping_required'],
            'category_id' => $this->goods['category_id'],
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'type' => GoodsState::TYPE_GENERAL,
            'buy_limit' => $this->goods['buy_limit'],
            'buy_limit_total' => $this->goods['buy_limit_total'],
        ];
    }
}

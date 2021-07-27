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

use App\Core\Dao\Goods\GoodsAttributeDao;
use App\Core\Dao\Goods\GoodsDao;
use App\Core\Dao\Goods\GoodsParameterDao;
use App\Core\Dao\Goods\GoodsSkuDao;
use App\Core\Dao\Goods\GoodsSkuSpecValueDao;
use App\Core\Dao\Goods\GoodsTimerDao;
use App\Exception\BadRequestException;
use App\Model\Goods\Goods;
use Hyperf\DbConnection\Db;
use Throwable;

abstract class AbstractTypesService implements InterfaceTypesService
{
    /**
     * 商品id.
     */
    protected int $id = 0;

    /**
     * 表单数据.
     */
    protected array $post = [];

    /**
     * 是否是创建.
     */
    protected bool $isCreated = false;

    /**
     * 商品信息.
     */
    protected Goods $goods;

    public function __construct(array $data, int $id = 0)
    {
        $this->id = $id;
        $this->post = $data;
    }

    public function create(): int
    {
        $this->isCreated = true;

        Db::beginTransaction();
        try {
            // 创建商品
            $data = $this->handleGoodsData();
            $goodsDao = new GoodsDao();
            $this->id = $goodsDao->create($data);

            $this->goods = $goodsDao->info($this->id);
            $this->syncAttribute();
            $this->syncTimer();
            $this->syncParameter();
            $this->syncSku();
            $this->setDefaultSkuId();

            Db::commit();
            return $this->id;
        } catch (Throwable $e) {
            Db::rollBack();
            throw new BadRequestException($e->getMessage());
        }
    }

    public function update(): array
    {
        Db::beginTransaction();
        try {
            // 创建商品
            $data = $this->handleGoodsData();
            $goodsDao = new GoodsDao();
            $goodsDao->update($this->id, $data);

            $this->goods = $goodsDao->info($this->id);
            $this->syncAttribute();
            $this->syncTimer();
            $this->syncParameter();
            $this->syncSku();
            $this->setDefaultSkuId();

            Db::commit();
            return $this->goods->toArray();
        } catch (Throwable $e) {
            Db::rollBack();
            throw new BadRequestException($e->getMessage());
        }
    }

    /**
     * 保存商品属性.
     */
    protected function syncAttribute(): void
    {
        (new GoodsAttributeDao())->updateOrCreate(['goods_id' => $this->id], $this->post['attribute']);
    }

    /**
     * 保存商品定时.
     */
    protected function syncTimer(): void
    {
        (new GoodsTimerDao())->updateOrCreate(['goods_id' => $this->id], $this->post['timer']);
    }

    /**
     * 保存商品参数.
     */
    protected function syncParameter(): void
    {
        $goodsParameterDao = new GoodsParameterDao();
        $goodsParameterDao->deleteByPrimaryKeys([$this->id]);

        $insert = [];
        $now = time();
        foreach ($this->post['parameter'] as $item) {
            $insert[] = [
                'goods_id' => $this->id,
                'option' => $item['option'],
                'value' => $item['value'],
                'created_time' => $now,
                'updated_time' => $now,
            ];
        }

        $goodsParameterDao->batchInsert($insert);
    }

    /**
     * 保存商品sku数据.
     */
    protected function syncSku(): void
    {
        $sku = $this->post['sku'];
        $goodsSkuDao = new GoodsSkuDao();
        $goodsSkuSpecValueDao = new GoodsSkuSpecValueDao();

        $insert = [];
        $update = [];
        $delete = [];
        if (! $this->isCreated) {
            // 新增
            $insert = $sku;
        } else {
            // 修改
            foreach ($sku as $item) {
                if (isset($item['id']) && intval($item['id']) > 0) {
                    $update[] = $item;
                } else {
                    $insert[] = $item;
                }
            }

            // 需要删除的商品规格
            $updateSkuIds = array_column($update, 'id');
            $skuList = $goodsSkuDao->getListByCondition([['goods_id', '=', $this->id]]);
            foreach ($skuList as $item) {
                if (empty($updateSkuIds) || ! in_array($item['id'], $updateSkuIds)) {
                    $delete[] = $item;
                }
            }
        }

        // 新增商品规格
        if (! empty($insert)) {
            foreach ($insert as $item) {
                unset($item['id']);
                $item['goods_id'] = $this->id;
                $skuId = $goodsSkuDao->create($item);

                $this->batchInsertSkuSpecValue($skuId, $item['spec_value']);
            }
        }

        // 修改商品规格
        if (! empty($update)) {
            foreach ($update as $item) {
                // 删除原有删除规格属性
                $goodsSkuSpecValueDao->deleteByCondition([['goods_sku_id', '=', $item['id']]]);

                // 更新新的规格属性
                $goodsSkuDao->update($item['id'], $item);
                $this->batchInsertSkuSpecValue($item['id'], $item['spec_value']);
            }
        }

        // 删除商品规格
        if (! empty($delete)) {
            foreach ($delete as $item) {
                $goodsSkuDao->remove($item['id']);
                $goodsSkuSpecValueDao->deleteByCondition([['goods_sku_id', '=', $item['id']]]);
            }
        }
    }

    /**
     * 设置关联的默认商品规格
     */
    protected function setDefaultSkuId(): void
    {
        $skuList = (new GoodsSkuDao())->getListByCondition([['goods_id', '=', $this->id]]);
        $defaultSkuId = 0;
        foreach ($skuList as $index => $item) {
            if ($index === 0) {
                $defaultSkuId = $item['id'];
            }
            if ($item['is_default']) {
                $defaultSkuId = $item['id'];
                break;
            }
        }

        $this->goods->default_sku_id = $defaultSkuId;
        $this->goods->save();
    }

    /**
     * 批量增加商品规格属性.
     */
    protected function batchInsertSkuSpecValue(int $skuId, array $specValueData): void
    {
        $insert = [];
        $now = time();
        foreach ($specValueData as $item) {
            $insert[] = [
                'goods_sku_id' => $skuId,
                'spec_id' => $item['spec_id'],
                'spec_value_id' => $item['spec_value_id'],
                'created_time' => $now,
                'updated_time' => $now,
            ];
        }

        (new GoodsSkuSpecValueDao())->batchInsert($insert);
    }

    protected function handleGoodsData(): array
    {
        $sku = $this->post['sku'];
        $salePrice = array_column($sku, 'sale_price');
        sort($salePrice);
        $minPrice = $salePrice[0];
        $maxPrice = end($salePrice);

        if ($this->post['images'] && is_array($this->post['images'])) {
            $this->post['images'] = implode(',', $this->post['images']);
        }

        return [
            'shop_id' => $this->post['shop_id'] ?? 0,
            'user_id' => $this->post['user_id'],
            'brand_id' => $this->post['brand_id'],
            'category_id' => $this->post['category_id'],
            'type' => $this->post['type'],
            'name' => $this->post['name'],
            'introduction' => $this->post['introduction'],
            'keyword' => $this->post['keyword'],
            'sale_price_min' => $minPrice,
            'sale_price_max' => $maxPrice,
            'achieve_price' => $this->post['achieve_price'],
            'status' => $this->post['status'],
            'recommend_way' => $this->post['recommend_way'],
            'is_consume_discount' => $this->post['is_consume_discount'],
            'is_free_shipping' => $this->post['is_free_shipping'],
            'buy_max' => $this->post['buy_max'],
            'buy_min' => $this->post['buy_min'],
            'refund_type' => $this->post['refund_type'],
            'images' => $this->post['images'],
            'video_url' => $this->post['video_url'] ?? '',
        ];
    }
}

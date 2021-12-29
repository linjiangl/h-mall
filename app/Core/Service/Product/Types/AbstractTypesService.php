<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Product\Types;

use App\Core\Dao\Product\ProductAttributeDao;
use App\Core\Dao\Product\ProductDao;
use App\Core\Dao\Product\ProductSkuDao;
use App\Core\Dao\Product\ProductSpecificationDao;
use App\Core\Dao\Product\ProductTimerDao;
use App\Exception\BadRequestException;
use App\Exception\InternalException;
use App\Model\Product\Product;
use App\Model\Product\ProductSpecification;
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
    protected Product $product;

    /**
     * 商品规格.
     */
    protected array $productSpecification;

    public function __construct(array $data, int $id = 0)
    {
        $this->id = $id;
        $this->post = $data;
    }

    public function create(): Product
    {
        $this->isCreated = true;
        $data = $this->handleGoodsData();

        Db::beginTransaction();
        try {
            // 创建商品
            $goodsDao = new ProductDao();
            $this->product = $goodsDao->create($data);
            $this->id = $this->product->id;

            $this->syncAttribute();
            $this->syncTimer();
            $this->syncSpecification();
            $this->syncProductSku();
            $this->setDefaultSkuId();

            Db::commit();
            return $this->product;
        } catch (Throwable $e) {
            Db::rollBack();
            write_logs('创建失败', $data);
            throw new BadRequestException($e->getMessage());
        }
    }

    public function update(): Product
    {
        $data = $this->handleGoodsData();

        Db::beginTransaction();
        try {
            // 修改商品
            $goodsDao = new ProductDao();
            $this->product = $goodsDao->update($this->id, $data);

            $this->syncAttribute();
            $this->syncTimer();
            $this->syncSpecification();
            $this->syncProductSku();
            $this->setDefaultSkuId();

            Db::commit();
            return $this->product;
        } catch (Throwable $e) {
            Db::rollBack();
            write_logs('修改失败', $data);
            throw new BadRequestException($e->getMessage());
        }
    }

    /**
     * 保存商品属性.
     */
    protected function syncAttribute(): void
    {
        (new ProductAttributeDao())->updateOrCreate(['goods_id' => $this->id], $this->post['attribute']);
    }

    /**
     * 保存商品定时.
     */
    protected function syncTimer(): void
    {
        (new ProductTimerDao())->updateOrCreate(['goods_id' => $this->id], $this->post['timer']);
    }

    /**
     * 保存商品规格
     */
    protected function syncSpecification(): void
    {
        // 删除所有规格
        (new ProductSpecificationDao())->deleteByGoodsId($this->id);

        // 添加商品规格
        foreach ($this->post['specs'] as $item) {
            $goodsSpecification = new ProductSpecification([
                'goods_id' => $this->id,
                'name' => $item['name'],
                'has_image' => $item['has_image'],
            ]);
            $goodsSpecification->save();

            $this->productSpecification[] = $goodsSpecification;
        }
    }

    /**
     * 保存商品sku数据.
     */
    protected function syncProductSku(): void
    {
        $goodsSkuDao = new ProductSkuDao();
        if (! $this->isCreated) {
            // 需要删除的商品规格
            $updateSkuIds = [];
            foreach ($this->post['skus'] as $item) {
                if (isset($item['id']) && intval($item['id']) > 0) {
                    $updateSkuIds[] = $item['id'];
                }
            }

            $deleteSkuIds = [];
            $skuList = $goodsSkuDao->getListByProductId($this->id);
            foreach ($skuList as $item) {
                if (empty($updateSkuIds) || ! in_array($item['id'], $updateSkuIds)) {
                    $deleteSkuIds[] = $item['id'];
                }
            }

            if (! empty($deleteSkuIds)) {
                $goodsSkuDao->deleteByCondition([['id', 'in', $deleteSkuIds]]);
            }
        }

        // 创建或更新sku数据
        foreach ($this->post['skus'] as $sku) {
            $temp = [
                'shop_id' => $this->product->shop_id,
                'goods_id' => $this->id,
                'sku_name' => $sku['sku_name'],
                'sku_no' => $sku['sku_no'] ?? '',
                'sale_price' => $sku['sale_price'],
                'market_price' => $sku['market_price'] ?? $sku['sale_price'],
                'cost_price' => $sku['cost_price'] ?? $sku['sale_price'],
                'stock' => $sku['stock'],
                'stock_alarm' => $sku['stock_alarm'],
                'virtual_sales' => $sku['virtual_sales'] ?? 0,
                'weight' => $sku['weight'] ?? 0,
                'volume' => $sku['weight'] ?? 0,
                'is_default' => $sku['is_default'],
                'image' => $sku['image'] ?? '',
            ];
            if (isset($sku['id']) && $sku['id'] > 0) {
                // 修改
                $goodsSku = $goodsSkuDao->update($sku['id'], $temp);
            } else {
                // 新建
                $goodsSku = $goodsSkuDao->create($temp);
            }

            foreach ($sku['spec_values'] as $index => $item) {
                if ($this->productSpecification[$index]['has_image'] && ! $item['image']) {
                    throw new InternalException(sprintf('%s 规格需要上传图片！', $item['name']));
                }
                $goodsSpecification = new ProductSpecification([
                    'goods_id' => $this->id,
                    'goods_sku_id' => $goodsSku->id,
                    'parent_id' => $this->productSpecification[$index]['id'],
                    'name' => $item['name'],
                    'image' => $item['image'],
                ]);
                $goodsSpecification->save();
            }
        }
    }

    /**
     * 设置关联的默认商品规格
     */
    protected function setDefaultSkuId(): void
    {
        $skuList = (new ProductSkuDao())->getListByProductId($this->id);
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

        $this->product->default_sku_id = $defaultSkuId;
        $this->product->save();
    }

    protected function handleGoodsData(): array
    {
        $sku = $this->post['skus'];
        $salePrice = array_column($sku, 'sale_price');
        sort($salePrice);
        $minPrice = $salePrice[0];
        $maxPrice = end($salePrice);

        return [
            'shop_id' => $this->post['shop_id'] ?? config('custom')['shop']['system_shop_id'],
            'brand_id' => $this->post['brand_id'] ?? 0,
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

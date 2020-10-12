<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Product\Types;

use App\Constants\State\ProductState;
use App\Core\Dao\Product\ProductDao;
use App\Exception\BadRequestException;
use Hyperf\DbConnection\Db;
use Throwable;

abstract class AbstractTypesService implements InterfaceTypesService
{
    /**
     * 商品id
     * @var int
     */
    protected $productId = 0;

    /**
     * 商品数据
     * @var array
     */
    protected $product = [];

    public function __construct(array $data, int $id = 0)
    {
        $this->productId = $id;
        $this->product = $data;
    }

    public function create(): int
    {
        Db::beginTransaction();
        try {
            // 创建商品
            $data = $this->handleProductData();
            $productDao = new ProductDao();
            $id = $productDao->create($data);

            // 关联规格
            $product = $productDao->info($id);
            if (isset($data['option_ids']) && count($data['option_ids']) > 0) {
                $product->specs()->sync($data['option_ids']);
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
        return $this->product;
    }

    protected function handleProductData()
    {
        $sku = $this->product['sku'];
        $skuPrice = array_column($sku, 'price');
        sort($skuPrice);
        $minPrice = $skuPrice[0];
        $maxPrice = end($skuPrice);

        return [
            'shop_id' => $this->product['shop_id'],
            'title' => $this->product['title'],
            'sub_title' => $this->product['sub_title'],
            'images' => $this->product['images'] ? json_encode(explode(',', $this->product['images'])) : '',
            'description_id' => $this->product['description_id'] ?? 0,
            'shipping_required' => $this->product['shipping_required'],
            'category_id' => $this->product['category_id'],
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'type' => ProductState::TYPE_GENERAL,
            'buy_limit' => $this->product['buy_limit'],
            'buy_limit_total' => $this->product['buy_limit_total'],
        ];
    }
}

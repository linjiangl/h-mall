<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Product;

use App\Core\Dao\Product\ProductDao;
use App\Core\Service\AbstractService;
use App\Core\Service\Product\Types\TypesService;
use App\Model\Product\Product;

class ProductService extends AbstractService
{
    protected string $dao = ProductDao::class;

    public function create(array $data): Product
    {
        return (new TypesService($data))->getInstance()->create();
    }

    public function update(int $id, array $data): Product
    {
        return (new TypesService($data, $id))->getInstance()->update();
    }

    /**
     * 处理商品详情.
     */
    public function convertProductDetail(array $productDetail): array
    {
        $idx = [];
        foreach ($productDetail['skus'] as $item) {
            $index = implode('::', array_column($item['spec_values'], 'name'));
            $idx[$index] = $item['id'];
        }
        $productDetail['sku_spec_idx'] = $idx;
        return $productDetail;
    }
}

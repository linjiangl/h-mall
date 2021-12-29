<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Goods;

use App\Core\Dao\Goods\GoodsDao;
use App\Core\Service\AbstractService;
use App\Core\Service\Goods\Types\TypesService;
use App\Model\Product\Product;

class GoodsService extends AbstractService
{
    protected string $dao = GoodsDao::class;

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
    public function convertGoodsDetail(array $goodsDetail): array
    {
        $idx = [];
        foreach ($goodsDetail['skus'] as $item) {
            $index = implode('::', array_column($item['spec_values'], 'name'));
            $idx[$index] = $item['id'];
        }
        $goodsDetail['sku_spec_idx'] = $idx;
        return $goodsDetail;
    }
}

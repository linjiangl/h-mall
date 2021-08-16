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
use App\Core\Service\Goods\Types\TypeService;

class GoodsService extends AbstractService
{
    protected string $dao = GoodsDao::class;

    public function create(array $data): int
    {
        return (new TypeService($data))->create();
    }

    public function update(int $id, array $data): array
    {
        return (new TypeService($data, $id))->update();
    }

    /**
     * 处理商品详情.
     */
    public function convertGoodsDetail(array $goodsDetail): array
    {
        $idx = [];
        foreach ($goodsDetail['skus'] as $item) {
            $index = implode('::', array_column($item['specs'], 'name'));
            $idx[$index] = $item['id'];
        }
        $goodsDetail['sku_spec_idx'] = $idx;
        return $goodsDetail;
    }
}

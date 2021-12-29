<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Product\Category;

use App\Constants\State\Product\CategoryState;
use App\Constants\State\Product\GoodsState;
use App\Core\Dao\Product\Category\CategoryDao;
use Hyperf\Database\Model\Relations\Relation;

class CategoryGoodsService
{
    /**
     * 首页分类推荐的商品数据.
     *
     * 推荐的商品条件：
     *  1. 上架的商品
     *  2. 销量最高的商品
     */
    public static function recommend(int $goodsNumber = 8): array
    {
        $dao = new CategoryDao();

        $list = $dao->getListByCondition([
            'parent_id' => 0,
            'status' => CategoryState::STATUS_ENABLED,
        ], [
            'children' => function (Relation $query) use ($goodsNumber) {
                $query->with([
                    'goodsList' => function (Relation $query) use ($goodsNumber) {
                        $query->where('status', GoodsState::STATUS_ON_SALE)->orderBy('sales', 'desc')->limit($goodsNumber);
                    },
                    'goodsList.default',
                ]);
            },
        ]);

        // 删除没有商品的分类
        foreach ($list as $index => $item) {
            $hasGoods = false;
            foreach ($item['children'] as $key => $value) {
                if (! empty($value['goods_list'])) {
                    $hasGoods = true;
                } else {
                    unset($item['children'][$key]);
                }
            }

            if ($hasGoods) {
                $item['children'] = array_values($item['children']);
                $list[$index] = $item;
            } else {
                unset($list[$index]);
            }
        }

        return array_values($list);
    }
}

<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Category;

use App\Core\Dao\Category\CategorySpecDao;
use App\Core\Service\AbstractService;

class CategorySpecService extends AbstractService
{
    protected string $dao = CategorySpecDao::class;

    /**
     * 创建分类规格
     * @param int $categoryId
     * @param array $specIds
     */
    public function createCategorySpecs(int $categoryId, array $specIds)
    {
        $insert = [];
        foreach ($specIds as $item) {
            $insert[] = [
                'category_id' => $categoryId,
                'spec_id' => $item,
            ];
        }
        $this->batchInsert($insert);
    }

    /**
     * 更新分类规格
     * @param array $category
     * @param array $specIds
     */
    public function updateCategorySpecs(array $category, array $specIds)
    {
        $dao = new CategorySpecDao();
        $oldCategorySpecs = $dao->getListByCategoryId($category['id']);
        $oldSpecIds = array_column($oldCategorySpecs, 'spec_id');

        // 删除规格
        $deleteSpecIds = array_diff($oldSpecIds, $specIds);
        if (count($deleteSpecIds)) {
            $dao->deleteByCondition([
                ['category_id', '=', $category['id']],
                ['spec_id', 'in', $deleteSpecIds]
            ]);
        }

        // 新增规格值
        $insertSpecIds = array_diff($specIds, $oldSpecIds);
        if (count($insertSpecIds)) {
            $this->createCategorySpecs($category['id'], $specIds);
        }
    }

    public function removeByCategoryId(int $categoryId): void
    {
        $dao = new CategorySpecDao();
        $dao->deleteByCondition([['category_id', '=', $categoryId]]);
    }
}

<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Goods\Category;

use App\Core\Dao\AbstractDao;
use App\Model\Category\CategorySpec;

class CategorySpecDao extends AbstractDao
{
    protected string $model = CategorySpec::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '分类规格不存在';

    public function getListByCategoryId(int $categoryId): array
    {
        return $this->getListByCondition([['category_id', '=', $categoryId]]);
    }

    /**
     * 检查规格下是否有分类
     * @param int $specId
     * @return bool
     */
    public function checkSpecIdHasCategory(int $specId): bool
    {
        $result = false;
        if (CategorySpec::query()->where('spec_id', $specId)->count()) {
            $result = true;
        }

        return $result;
    }
}

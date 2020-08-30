<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Category;

use App\Core\Dao\AbstractDao;
use App\Model\Category\CategorySpec;

class CategorySpecDao extends AbstractDao
{
    protected $model = CategorySpec::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '分类规格不存在';

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

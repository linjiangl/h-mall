<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Product\Category;

use App\Constants\State\Goods\CategoryState;
use App\Core\Dao\AbstractDao;
use App\Model\Category\Category;
use Hyperf\Database\Model\Model;

class CategoryDao extends AbstractDao
{
    protected string|Model $model = Category::class;

    protected string $notFoundMessage = '分类不存在';

    protected string $orderBy = 'parent_id asc, sorting asc';

    public function getListByStatus($status = CategoryState::STATUS_ENABLED, string $select = '*'): array
    {
        $condition = [];
        if ($status !== null) {
            $condition[] = ['status', '=', $status];
        }
        return $this->getListByCondition($condition, [], $select);
    }

    public function getListByParentId(int $parentId = 0, $status = CategoryState::STATUS_ENABLED): array
    {
        $condition = [['parent_id', '=', $parentId]];
        if ($status !== null) {
            $condition[] = ['status', '=', $status];
        }
        return $this->getListByCondition($condition, [], 'id,parent_id,name', $this->orderBy);
    }
}

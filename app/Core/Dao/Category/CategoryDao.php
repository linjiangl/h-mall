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
use App\Model\Category\Category;

class CategoryDao extends AbstractDao
{
    protected string $model = Category::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '分类不存在';

    protected string $orderBy = 'sorting asc';

    public function getListByStatus($status = null, string $select = '*'): array
    {
        $condition = [];
        if ($status !== null) {
            $condition[] = ['status', '=', $status];
        }
        return $this->getListByCondition($condition, [], $select);
    }

    public function getListByParentId(int $parentId = 0, $status = null)
    {
        $condition = [['parent_id', '=', $parentId]];
        if ($status !== null) {
            $condition[] = ['status', '=', $status];
        }
        return $this->getListByCondition($condition, [], 'id,parent_id,name', $this->orderBy);
    }
}

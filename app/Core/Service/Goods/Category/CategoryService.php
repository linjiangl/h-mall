<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Goods\Category;

use App\Core\Dao\Goods\Category\CategoryDao;
use App\Core\Service\AbstractService;

class CategoryService extends AbstractService
{
    protected string $dao = CategoryDao::class;

    protected array $levelData = [];

    /**
     * 根据状态获取列表数据.
     * @param mixed $status
     */
    public function getListByStatus($status = null, string $select = '*'): array
    {
        return (new CategoryDao())->getListByStatus($status, $select);
    }

    /**
     * 根据分类获取分类.
     * @param mixed $status
     */
    public function getListByParentId(int $parentId = 0, $status = null): array
    {
        return (new CategoryDao())->getListByParentId($parentId, $status);
    }

    /**
     * 分类数据归类.
     */
    public function convertCategoriesToChildren(array $categories, int $parentId = 0, int $level = 1): array
    {
        $list = [];
        foreach ($categories as $item) {
            if ($item['parent_id'] === $parentId) {
                $item['level'] = $level;
                $children = $this->convertCategoriesToChildren($categories, $item['id'], $level + 1);
                if (! empty($children)) {
                    $item['children'] = $children;
                }
                $list[] = $item;
            }
        }
        return $list;
    }

    /**
     * 分类数据分层
     */
    public function convertCategoriesToLevel(array $categories, int $parentId = 0, int $level = 1): array
    {
        foreach ($categories as $v) {
            if ($v['parent_id'] == $parentId) {
                $v['level'] = $level;
                $this->levelData[] = $v;
                $this->convertCategoriesToLevel($categories, $v['id'], $level + 1);
            }
        }
        return $this->levelData;
    }

    /**
     * 获取包含自己在内的所有子类ID.
     * @param null $status
     */
    public function getChildrenIds(int $parentId, $status = null): array
    {
        $categories = $this->getListByStatus($status, 'id,parent_id');
        $categories = $this->convertCategoriesToLevel($categories);
        $ids = [];
        foreach ($categories as $item) {
            if ($item['id'] == $parentId || $item['parent_id'] == $parentId) {
                $ids[] = $item['id'];
            }
        }
        return $ids;
    }

    /**
     * 获取分类所有父级ID.
     * @param null $status
     */
    public function getAllParentIds(int $categoryId, $status = null): array
    {
        $categories = $this->getListByStatus($status, 'id,parent_id');
        $categories = $this->convertCategoriesToLevel($categories);
        $selfCategory = [];
        $data = [];
        foreach ($categories as $val) {
            $data[] = $val;
            if ($val['id'] == $categoryId) {
                $selfCategory = $val;
                break;
            }
        }
        foreach ($data as $key => $val) {
            if ($val['level'] == $selfCategory['level']) {
                unset($data[$key]);
            }
        }
        return array_column($data, 'id');
    }
}

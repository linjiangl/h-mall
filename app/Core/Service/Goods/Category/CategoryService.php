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

use App\Constants\State\Goods\CategoryState;
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
    public function getListByStatus($status = CategoryState::STATUS_ENABLED, string $select = '*'): array
    {
        return (new CategoryDao())->getListByStatus($status, $select);
    }

    /**
     * 根据分类获取分类.
     * @param mixed $status
     */
    public function getListByParentId(int $parentId = 0, $status = CategoryState::STATUS_ENABLED): array
    {
        return (new CategoryDao())->getListByParentId($parentId, $status);
    }

    /**
     * 分类数据归类.
     * @param array $cascadesValue 级选的值
     * @param array $cascadesLabel 级选的标签
     */
    public function convertCategoriesToChildren(array $categories, int $parentId = 0, int $level = 1, array $cascadesValue = [], array $cascadesLabel = []): array
    {
        $list = [];
        foreach ($categories as $item) {
            $item['cascades_value'] = array_merge($cascadesValue, [$item['id']]);
            $item['cascades_label'] = array_merge($cascadesLabel, [$item['name']]);
            if ($item['parent_id'] === $parentId) {
                $item['level'] = $level;
                $children = $this->convertCategoriesToChildren($categories, $item['id'], $level + 1, $item['cascades_value'], $item['cascades_label']);
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
     * 获取指定分类的子级.
     * @param mixed $status
     */
    public function getChildrenCategories(int $categoryId, $status = CategoryState::STATUS_ENABLED): array
    {
        $categories = $this->getListByStatus($status, 'id,parent_id');
        $categories = $this->convertCategoriesToLevel($categories);
        $childrenCategories = [];
        // 到指定分类时，设置为true
        $start = false;
        // 指定分类的层次
        $level = 0;
        foreach ($categories as $item) {
            if ($start) {
                if ($item['level'] > $level) {
                    $childrenCategories[] = $item;
                }
                if ($item['level'] == $level) {
                    break;
                }
            }

            if ($item['id'] == $categoryId) {
                $childrenCategories[] = $item;
                $start = true;
                $level = $item['level'];
            }
        }
        return $childrenCategories;
    }

    /**
     * 获取指定分类的子级id.
     * @param mixed $status
     */
    public function getChildrenIds(int $categoryId, $status = CategoryState::STATUS_ENABLED): array
    {
        return array_column($this->getChildrenCategories($categoryId, $status), 'id');
    }

    /**
     * 获取指定分类的父级.
     * @param mixed $status
     */
    public function getParentCategories(int $categoryId, $status = CategoryState::STATUS_ENABLED): array
    {
        $categories = $this->getListByStatus($status);
        $categories = $this->convertCategoriesToLevel($categories);
        $categories = array_reverse($categories);
        $parentCategories = [];
        // 到指定分类时，设置为true
        $start = false;
        // 当前的层次
        $level = 0;
        foreach ($categories as $item) {
            if ($start) {
                if ($item['level'] < $level) {
                    $parentCategories[] = $item;
                    --$level;
                }
                if ($item['level'] === 1) {
                    break;
                }
            }

            if ($item['id'] == $categoryId) {
                $parentCategories[] = $item;
                $start = true;
                $level = $item['level'];
            }
        }
        return $parentCategories;
    }

    /**
     * 获取指定分类的父级ID.
     * @param mixed $status
     */
    public function getParentIds(int $categoryId, $status = CategoryState::STATUS_ENABLED): array
    {
        return array_column($this->getParentCategories($categoryId, $status), 'id');
    }
}

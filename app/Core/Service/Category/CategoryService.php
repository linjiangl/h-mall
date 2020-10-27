<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Category;

use App\Constants\Message\ProductMessage;
use App\Core\Dao\Category\CategoryDao;
use App\Core\Dao\Product\ProductDao;
use App\Core\Service\AbstractService;
use App\Exception\BadRequestException;
use App\Exception\InternalException;
use Throwable;

class CategoryService extends AbstractService
{
    protected $dao = CategoryDao::class;

    protected $levelData = [];

    public function create(array $data): int
    {
        try {
            // 创建分类
            $id = parent::create($data);

            // 保存规格
            if (! empty($data['spec_ids'])) {
                $specIds = is_array($data['spec_ids']) ? $data['spec_ids'] : explode(',', $data['spec_ids']);
                $categorySpecService = new CategorySpecService();
                $categorySpecService->createCategorySpecs($id, $specIds);
            }

            return $id;
        } catch (Throwable $e) {
            write_logs('创建失败', $data);
            throw new BadRequestException($e->getMessage(), $e->getCode());
        }
    }

    public function update(int $id, array $data): array
    {
        try {
            $category = parent::update($id, $data);

            // 保存规格
            if (! empty($data['spec_ids'])) {
                $specIds = is_array($data['spec_ids']) ? $data['spec_ids'] : explode(',', $data['spec_ids']);
                $categorySpecService = new CategorySpecService();
                $categorySpecService->updateCategorySpecs($category, $specIds);
            }

            return $category;
        } catch (Throwable $e) {
            write_logs('保存失败', $data);
            throw new BadRequestException($e->getMessage(), $e->getCode());
        }
    }

    public function remove(int $id): bool
    {
        $productDao = new ProductDao();
        if ($productDao->checkCategoryIdHasProduct($id)) {
            throw new InternalException(ProductMessage::getMessage(ProductMessage::CHECK_CATEGORY_ID_HAS_CATEGORY));
        }

        try {
            $categorySpecService = new CategorySpecService();
            $categorySpecService->removeByCategoryId($id);

            return parent::remove($id);
        } catch (Throwable $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 根据状态获取列表数据
     * @param mixed $status
     * @param string $select
     * @return array
     */
    public function getListByStatus($status = null, string $select = '*'): array
    {
        $dao = new CategoryDao();
        return $dao->getListByStatus($status, $select);
    }

    /**
     * 根据分类获取分类
     * @param int $parentId
     * @param mixed $status
     * @return array
     */
    public function getListByParentId(int $parentId = 0, $status = null)
    {
        $dao = new CategoryDao();
        return $dao->getListByParentId($parentId, $status);
    }

    /**
     * 分类数据归类
     * @param array $categories
     * @param int $parentId
     * @param int $level
     * @return array
     */
    public function convertCategoriesToChildren(array $categories, $parentId = 0, $level = 1): array
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
     * @param array $categories
     * @param int $parentId
     * @param int $level
     * @return array
     */
    public function convertCategoriesToLevel(array $categories, $parentId = 0, $level = 1): array
    {
        foreach ($categories as $k => $v) {
            if ($v['parent_id'] == $parentId) {
                $v['level'] = $level;
                $this->levelData[] = $v;
                $this->convertCategoriesToLevel($categories, $v['id'], $level + 1);
            }
        }
        return $this->levelData;
    }

    /**
     * 获取包含自己在内的所有子类ID
     * @param int $parentId
     * @param null $status
     * @return array
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
     * 获取分类所有父级ID
     * @param int $categoryId
     * @param null $status
     * @return array
     */
    public function getAllParentIds(int $categoryId, $status = null): array
    {
        $categories = $this->getListByStatus($status, 'id,parent_id');
        $categories = $this->convertCategoriesToLevel($categories);
        $selfCategory = [];
        $data = [];
        foreach ($categories as $key => $val) {
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

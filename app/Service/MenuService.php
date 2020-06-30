<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Service;

use App\Dao\MenuDao;

class MenuService extends AbstractService
{
    protected $dao = MenuDao::class;

    protected $levelMenus = [];

    /**
     * 获取树形菜单
     * @param mixed $status
     * @return array
     */
    public function getTreeMenus($status = null): array
    {
        $dao = new MenuDao();
        $allMenus = $dao->getListByStatus($status, 'id,parent_id,title,name,icon,path');
        return $this->handleMenusToChildren($allMenus);
    }

    /**
     * 获取层次菜单
     * @param mixed $status
     * @return array
     */
    public function getLevelMenus($status = null): array
    {
        $dao = new MenuDao();
        $allMenus = $dao->getListByStatus($status, 'id,parent_id,title,name,icon,path');
        return $this->handleMenusToLevel($allMenus);
    }

    /**
     * 把菜单转成子菜单
     * @param array $allMenus 全部菜单数据
     * @param int $parentId 父级
     * @param int $level 层级
     * @return array
     */
    protected function handleMenusToChildren(array $allMenus, int $parentId = 0, int $level = 1): array
    {
        $list = [];
        foreach ($allMenus as $item) {
            if ($item['parent_id'] == $parentId) {
                $item['level'] = $level;
                $children = $this->handleMenusToChildren($allMenus, $item['id'], $level + 1);
                if ($children) {
                    $item['children'] = $children;
                }
                $list[] = $item;
            }
        }
        return $list;
    }

    /**
     * 把菜单分层
     * @param array $allMenus
     * @param int $parentId
     * @param int $level
     * @return array
     */
    protected function handleMenusToLevel(array $allMenus, int $parentId = 0, int $level = 1)
    {
        foreach ($allMenus as $k => $v) {
            if ($v['parent_id'] == $parentId) {
                $v['level'] = $level;
                $this->levelMenus[] = $v;
                $this->handleMenusToLevel($allMenus, $v['id'], $level + 1);
            }
        }
        return $this->levelMenus;
    }
}

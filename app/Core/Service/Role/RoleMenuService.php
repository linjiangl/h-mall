<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Role;

use App\Constants\RestConstants;
use App\Core\Dao\MenuDao;
use App\Core\Dao\Role\RoleDao;
use App\Core\Dao\Role\RoleMenuDao;
use App\Exception\BadRequestException;
use App\Core\Service\AbstractService;

class RoleMenuService extends AbstractService
{
    protected $dao = RoleMenuDao::class;

    /**
     * 修改权限菜单
     * @param int $roleId
     * @param int $menuId
     * @param bool $check 是否选中
     * @return bool
     */
    public function changeRoleMenu(int $roleId, int $menuId, bool $check = false)
    {
        if ($check) {
            // 选中菜单
            $roleDao = new RoleDao();
            $role = $roleDao->info($roleId);
            $menuDao = new MenuDao();
            $menu = $menuDao->info($menuId);
            try {
                $dao = new RoleMenuDao();
                if ($dao->getInfoByRoleMenuId($roleId, $menuId)) {
                    throw new BadRequestException('权限菜单已存在');
                }
            } catch (\Throwable $e) {
                if ($e->getCode() == RestConstants::HTTP_NOT_FOUND) {
                    $this->create([
                        'role_id' => $role->id,
                        'menu_id' => $menu->id
                    ]);
                } else {
                    throw new BadRequestException($e->getMessage());
                }
            }
        } else {
            // 删除菜单
            $model = new RoleMenuDao();
            $roleMenu = $model->getInfoByRoleMenuId($roleId, $menuId);
            $model->remove($roleMenu->id);
        }
        return true;
    }
}

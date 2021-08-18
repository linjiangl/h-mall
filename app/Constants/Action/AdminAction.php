<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Constants\Action;

use App\Constants\TraitConstants;
use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 */
class AdminAction extends AbstractConstants
{
    use TraitConstants;

    /**
     * @Message("创建管理员账号")
     */
    public const ADMIN_CREATE = 'admin_create';

    /**
     * @Message("修改管理员信息")
     */
    public const ADMIN_UPDATE = 'admin_update';

    /**
     * @Message("创建菜单")
     */
    public const MENU_CREATE = 'menu_create';

    /**
     * @Message("修改菜单")
     */
    public const MENU_UPDATE = 'menu_update';

    /**
     * @Message("删除菜单")
     */
    public const MENU_DELETE = 'menu_delete';

    /**
     * @Message("创建权限")
     */
    public const ROLE_CREATE = 'role_create';

    /**
     * @Message("修改权限")
     */
    public const ROLE_UPDATE = 'role_update';

    /**
     * @Message("删除权限")
     */
    public const ROLE_DELETE = 'role_delete';

    /**
     * @Message("设置权限菜单")
     */
    public const ROLE_MENU_CHANGE = 'ROLE_MENU_CHANGE';
}

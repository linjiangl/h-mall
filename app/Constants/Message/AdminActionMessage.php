<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Constants\Message;

use App\Constants\TraitConstants;
use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants()
 */
class AdminActionMessage extends AbstractConstants
{
    use TraitConstants;

    /**
     * @Message("创建管理员账号")
     */
    const ADMIN_CREATE = 'admin_create';

    /**
     * @Message("修改管理员信息")
     */
    const ADMIN_UPDATE = 'admin_update';

    /**
     * @Message("创建菜单")
     */
    const MENU_CREATE = 'menu_create';

    /**
     * @Message("修改菜单")
     */
    const MENU_UPDATE = 'menu_update';

    /**
     * @Message("删除菜单")
     */
    const MENU_DELETE = 'menu_delete';
}

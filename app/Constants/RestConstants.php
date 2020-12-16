<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 *  @Constants()
 */
class RestConstants extends AbstractConstants
{
    use TraitConstants;

    /**
     * @Message("创建成功")
     */
    const HTTP_CREATED = 201;

    /**
     * @Message("修改成功")
     */
    const HTTP_UPDATED = 200;

    /**
     * @Message("删除成功")
     */
    const HTTP_DELETED = 204;

    /**
     * @Message("NOT FOUND")
     */
    const HTTP_NOT_FOUND = 404;
}

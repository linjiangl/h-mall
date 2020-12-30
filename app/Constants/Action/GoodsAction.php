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
 * @Constants()
 */
class GoodsAction extends AbstractConstants
{
    use TraitConstants;

    /**
     * @Message("创建分类")
     */
    const CATEGORY_CREATE = 'category_create';

    /**
     * @Message("修改分类")
     */
    const CATEGORY_UPDATE = 'category_update';

    /**
     * @Message("删除分类")
     */
    const CATEGORY_DELETE = 'category_delete';

    /**
     * @Message("创建规格")
     */
    const SPEC_CREATE = 'spec_create';

    /**
     * @Message("修改规格")
     */
    const SPEC_UPDATE = 'spec_update';

    /**
     * @Message("删除规格")
     */
    const SPEC_DELETE = 'spec_delete';
}

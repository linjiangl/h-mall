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
     * @Message("创建规格规格")
     */
    const SPEC_CREATE = 'spec_create';

    /**
     * @Message("修改规格规格")
     */
    const SPEC_UPDATE = 'spec_update';

    /**
     * @Message("删除规格规格")
     */
    const SPEC_DELETE = 'spec_delete';

    /**
     * @Message("创建商品品牌")
     */
    const BRAND_CREATE = 'brand_create';

    /**
     * @Message("修改商品品牌")
     */
    const BRAND_UPDATE = 'brand_update';

    /**
     * @Message("删除商品品牌")
     */
    const BRAND_DELETE = 'brand_delete';

    /**
     * @Message("创建商品服务")
     */
    const SERVICE_CREATE = 'service_create';

    /**
     * @Message("修改商品服务")
     */
    const SERVICE_UPDATE = 'service_update';

    /**
     * @Message("删除商品服务")
     */
    const SERVICE_DELETE = 'service_delete';

    /**
     * @Message("创建商品属性")
     */
    const PARAMETER_CREATE = 'parameter_create';

    /**
     * @Message("修改商品属性")
     */
    const PARAMETER_UPDATE = 'parameter_update';

    /**
     * @Message("删除商品属性")
     */
    const PARAMETER_DELETE = 'parameter_delete';

    /**
     * @Message("创建商品属性选项")
     */
    const PARAMETER_OPTION_CREATE = 'parameter_option_create';

    /**
     * @Message("修改商品属性选项")
     */
    const PARAMETER_OPTION_UPDATE = 'parameter_option_update';

    /**
     * @Message("删除商品属性选项")
     */
    const PARAMETER_OPTION_DELETE = 'parameter_option_delete';
}

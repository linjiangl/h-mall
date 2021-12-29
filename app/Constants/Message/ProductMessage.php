<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Constants\Message;

use App\Constants\TraitConstants;
use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 */
class ProductMessage extends AbstractConstants
{
    use TraitConstants;

    /**
     * @Message("该分类下存在分类")
     */
    public const CHECK_CATEGORY_ID_HAS_CATEGORY = 'check_category_id_has_category';

    /**
     * @Message("该规格下存在分类")
     */
    public const CHECK_SPEC_ID_HAS_CATEGORY = 'check_spec_id_has_category';

    /**
     * @Message("该规格下存在商品")
     */
    public const CHECK_SPEC_ID_HAS_GOODS = 'check_spec_id_has_goods';

    /**
     * @Message("该规格值下存在商品")
     */
    public const CHECK_SPEC_VALUE_ID_HAS_GOODS = 'check_spec_value_id_has_goods';
}

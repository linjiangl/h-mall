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
class ProductMessage extends AbstractConstants
{
    use TraitConstants;

    /**
     * @Message("该规格下存在商品")
     */
    const CHECK_SPEC_ID_HAS_PRODUCT = 'check_spec_id_has_product';

    /**
     * @Message("该规格值下存在商品")
     */
    const CHECK_SPEC_VALUE_ID_HAS_PRODUCT = 'check_spec_value_id_has_product';
}

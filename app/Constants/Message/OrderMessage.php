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
class OrderMessage extends AbstractConstants
{
    use TraitConstants;

    /**
     * @Message("订单支付成功,祝你购物愉快!")
     */
    const PAYMENT_SUCCESS = 'payment_success';
}

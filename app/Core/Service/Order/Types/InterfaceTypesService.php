<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Order\Types;

interface InterfaceTypesService
{
    /**
     * 订单结算.
     */
    public function settlement(array $products): array;
}

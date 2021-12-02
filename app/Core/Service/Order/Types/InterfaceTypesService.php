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
     * 设置参数.
     */
    public function setParams(array $params): static;

    /**
     * 结算接口.
     */
    public function settlement(): array;
}

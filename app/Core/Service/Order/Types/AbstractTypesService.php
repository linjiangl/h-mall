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

abstract class AbstractTypesService implements InterfaceTypesService
{
    protected array $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function settlement(array $user, array $products): array
    {
        return [];
    }
}

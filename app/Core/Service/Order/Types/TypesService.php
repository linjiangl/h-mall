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

use App\Exception\InternalException;

class TypesService
{
    public const TYPE_CART = CartService::class;

    protected InterfaceTypesService $class;

    public function __construct(string $class, array $user = [], array $params = [])
    {
        if (! class_exists($class)) {
            throw new InternalException('订单处理业务不存在');
        }

        $this->class = new $class($params, $user);
    }

    public function service()
    {
        return $this->class;
    }
}

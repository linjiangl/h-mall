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
    public const TYPE_CART = 'cart';

    protected InterfaceTypesService $class;

    protected array $mapClass = [
        self::TYPE_CART => CartService::class,
    ];

    public function __construct(string $type, array $user = [], array $params = [])
    {
        if (! in_array($type, array_keys($this->mapClass))) {
            throw new InternalException('订单处理业务不存在');
        }

        $this->class = new $this->mapClass[$type]($params, $user);
    }

    public function service()
    {
        return $this->class;
    }
}

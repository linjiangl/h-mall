<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Goods\Types;

/**
 * 优惠券商品
 */
class VirtualService extends AbstractTypesService
{
    public function __construct(array $data, int $id = 0)
    {
        parent::__construct($data, $id);
    }
}

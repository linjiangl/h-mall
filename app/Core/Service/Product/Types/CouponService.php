<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Product\Types;

/**
 * 优惠券商品
 */
class CouponService extends AbstractTypesService
{
    public function __construct(array $data, int $id = 0)
    {
        parent::__construct($data, $id);
    }

    public function create(): int
    {
        return $this->productId;
    }

    public function update(): array
    {
        return $this->product;
    }
}

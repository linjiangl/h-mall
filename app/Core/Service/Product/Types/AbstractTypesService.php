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

abstract class AbstractTypesService implements InterfaceTypesService
{
    /**
     * 商品id
     * @var int
     */
    protected $productId = 0;

    /**
     * 商品数据
     * @var array
     */
    protected $product = [];

    public function __construct(array $data, int $id = 0)
    {
        $this->product = $data;
        $this->productId = 0;
    }
}

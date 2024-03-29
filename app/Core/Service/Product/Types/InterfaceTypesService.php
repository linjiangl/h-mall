<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Product\Types;

use App\Model\Product\Product;

interface InterfaceTypesService
{
    /**
     * 创建商品
     */
    public function create(): Product;

    /**
     * 编辑商品
     */
    public function update(): Product;
}

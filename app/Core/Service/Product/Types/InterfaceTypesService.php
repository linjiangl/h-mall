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

interface InterfaceTypesService
{
    /**
     * 创建商品
     * @return int
     */
    public function create(): int;

    /**
     * 编辑商品
     * @return array
     */
    public function update(): array;
}

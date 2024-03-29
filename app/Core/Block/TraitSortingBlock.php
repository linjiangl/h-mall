<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Block;

trait TraitSortingBlock
{
    public function setDefaultOrderBy(): string
    {
        return 'sorting asc, id desc';
    }
}

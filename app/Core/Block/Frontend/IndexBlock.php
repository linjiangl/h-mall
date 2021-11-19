<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Frontend;

use App\Core\Block\BaseBlock;

class IndexBlock extends BaseBlock
{
    protected int $page = 1;

    public function paginate(): array
    {
        $page = request()->post('page', 1);
        $this->page = $this->page + $page;

        return [$page];
    }
}

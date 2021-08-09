<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\Goods;

use App\Core\Block\BaseBlock;
use App\Core\Service\Goods\GoodsService;

class GoodsBlock extends BaseBlock
{
    protected string $service = GoodsService::class;

    protected array $defaultSinceWith = [
        'backend' => [
            'index' => ['default'],
            'show' => ['attribute', 'timer', 'specs', 'skus', 'skus.specs'],
        ],
        'frontend' => [
            'index' => [],
            'show' => ['attribute', 'specs', 'skus', 'skus.specs'],
        ],
    ];

    public function show(): array
    {
        $detail = parent::show();
        return (new GoodsService())->convertGoodsDetail($detail);
    }
}

<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\Product\Category;

use App\Constants\BlockSinceConstants;
use App\Core\Block\BaseBlock;
use App\Core\Service\Product\Category\CategoryService;

class CategoryBlock extends BaseBlock
{
    protected string $service = CategoryService::class;

    protected array $query = [
        '=' => ['status', 'parent_id'],
    ];

    protected array $defaultSinceWith = [
        BlockSinceConstants::SINCE_BACKEND => [
            'paginate' => ['parent'],
            'info' => [],
        ],
        BlockSinceConstants::SINCE_FRONTEND => [
            'paginate' => [],
            'info' => [],
        ],
    ];

    public function parent(): array
    {
        $service = new CategoryService();
        return $service->getListByParentId();
    }

    public function children(): array
    {
        $service = new CategoryService();
        $categories = $service->getListByStatus();
        return $service->convertCategoriesToChildren($categories);
    }
}

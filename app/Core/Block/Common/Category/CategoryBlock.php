<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\Category;

use App\Core\Block\BaseBlock;
use App\Core\Service\Category\CategoryService;

class CategoryBlock extends BaseBlock
{
    protected string $service = CategoryService::class;

    protected array $query = [
        '=' => ['status', 'parent_id']
    ];

    public function parent(): array
    {
        $service = new CategoryService();
        return $service->getListByParentId(0);
    }

    public function children(): array
    {
        $service = new CategoryService();
        $categories = $service->getListByStatus();
        return $service->convertCategoriesToChildren($categories);
    }

    protected function beforeBuildQuery(): void
    {
        parent::beforeBuildQuery();

        switch ($this->action) {
            case 'index':
                $this->with = ['parent'];
                break;
        }
    }
}

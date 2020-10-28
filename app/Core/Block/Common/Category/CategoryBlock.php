<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\Category;

use App\Core\Block\BaseBlock;
use App\Core\Service\Category\CategoryService;

class CategoryBlock extends BaseBlock
{
    protected $service = CategoryService::class;

    protected $query = [
        '=' => ['status', 'parent_id']
    ];

    public function parent()
    {
        $service = new CategoryService();
        return $service->getListByParentId(0);
    }

    public function children()
    {
        $service = new CategoryService();
        $categories = $service->getListByStatus();
        return $service->convertCategoriesToChildren($categories);
    }

    protected function beforeBuildQuery()
    {
        parent::beforeBuildQuery();

        switch ($this->action) {
            case 'index':
                $this->with = ['parent'];
                break;
        }
    }
}

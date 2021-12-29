<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\Product;

use App\Core\Block\BaseBlock;
use App\Core\Block\TraitSortingBlock;
use App\Core\Service\Product\ServiceTemplateService;

class ServiceTemplateBlock extends BaseBlock
{
    use TraitSortingBlock;

    protected string $service = ServiceTemplateService::class;

    public function __construct()
    {
        parent::__construct();

        $this->orderBy = $this->setDefaultOrderBy();
    }

    protected function handleSoftDelete(): void
    {
    }
}

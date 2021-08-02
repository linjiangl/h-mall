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
use App\Core\Service\Goods\ServiceTemplateService;

class ServiceTemplateBlock extends BaseBlock
{
    protected string $service = ServiceTemplateService::class;

    public function __construct()
    {
        parent::__construct();
        $this->setSortingToOrderBy();
    }

    public function all(): array
    {
        $service = new ServiceTemplateService();
        return $service->all();
    }

    protected function handleSoftDelete(): void
    {
    }
}

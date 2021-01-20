<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\Goods\Spec;

use App\Core\Block\BaseBlock;
use App\Core\Service\Goods\Spec\SpecValueService;

class SpecValueBlock extends BaseBlock
{
    protected string $service = SpecValueService::class;

    public function getListBySpecId(): array
    {
        $specId = $this->request->post('spec_id');
        $service = new SpecValueService();
        return $service->getListBySpecId(intval($specId));
    }
}

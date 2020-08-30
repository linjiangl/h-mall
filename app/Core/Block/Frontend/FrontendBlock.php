<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Frontend;

use App\Core\Block\AbstractBlock;
use App\Core\Service\AbstractService;

class FrontendBlock extends AbstractBlock
{
    protected function service(): AbstractService
    {
        $service = parent::service();
        $authorize = request()->getAttribute('user');
        $authorize = $authorize ?: [];
        return $service->withAuthorize($authorize);
    }
}

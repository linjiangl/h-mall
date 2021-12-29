<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Product;

use App\Core\Dao\Product\ServiceTemplateDao;
use App\Core\Service\AbstractService;

class ServiceTemplateService extends AbstractService
{
    protected string $dao = ServiceTemplateDao::class;
}

<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Product\Parameter;

use App\Core\Dao\Product\Parameter\ParameterOptionsDao;
use App\Core\Service\AbstractService;

class ParameterOptionsService extends AbstractService
{
    protected string $dao = ParameterOptionsDao::class;
}

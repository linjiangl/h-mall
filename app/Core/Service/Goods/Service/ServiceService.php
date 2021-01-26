<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Goods\Service;

use App\Core\Dao\Goods\Service\ServiceDao;
use App\Core\Service\AbstractService;

class ServiceService extends AbstractService
{
    protected string $dao = ServiceDao::class;

    protected bool $softDelete = false;

    public function all(): array
    {
        $dao = new ServiceDao();
        return $dao->getListByCondition();
    }
}

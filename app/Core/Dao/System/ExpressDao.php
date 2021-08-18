<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\System;

use App\Core\Dao\AbstractDao;
use App\Model\Express;
use Hyperf\Database\Model\Model;

class ExpressDao extends AbstractDao
{
    protected string|Model $model = Express::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '快递公司不存在';
}

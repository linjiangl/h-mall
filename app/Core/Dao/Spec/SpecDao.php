<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Spec;

use App\Core\Dao\AbstractDao;
use App\Model\Spec\Spec;

class SpecDao extends AbstractDao
{
    protected string $model = Spec::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '商品规格不存在';
}

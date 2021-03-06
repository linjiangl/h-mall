<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Goods\Parameter;

use App\Core\Dao\AbstractDao;
use App\Model\Parameter\ParameterOption;

class ParameterOptionsDao extends AbstractDao
{
    protected string $model = ParameterOption::class;

    protected array $noAllowActions = [];

    public function info(int $id, array $with = []): ParameterOption
    {
        return parent::info($id, $with);
    }
}

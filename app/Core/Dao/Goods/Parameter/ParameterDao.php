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
use App\Model\Parameter\Parameter;

class ParameterDao extends AbstractDao
{
    protected string $model = Parameter::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '商品参数不存在或已删除';

    public function info(int $id, array $with = []): Parameter
    {
        return parent::info($id, $with);
    }
}

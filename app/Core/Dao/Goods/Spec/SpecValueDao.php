<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Goods\Spec;

use App\Core\Dao\AbstractDao;
use App\Model\Spec\SpecValue;

class SpecValueDao extends AbstractDao
{
    protected string $model = SpecValue::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '商品规格值不存在';

    public function getListBySpecId(int $specId): array
    {
        return $this->getListByCondition([['spec_id', '=', $specId]], [], '*', 'sorting asc,id asc');
    }
}

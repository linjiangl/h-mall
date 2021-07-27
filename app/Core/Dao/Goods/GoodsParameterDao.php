<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Goods;

use App\Core\Dao\AbstractDao;
use App\Model\Goods\GoodsParameter;

class GoodsParameterDao extends AbstractDao
{
    protected string $model = GoodsParameter::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '商品参数不存在或已删除';

    public function info(int $id, array $with = []): GoodsParameter
    {
        return parent::info($id, $with);
    }
}

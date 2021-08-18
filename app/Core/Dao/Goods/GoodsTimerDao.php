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
use App\Model\Goods\GoodsTimer;
use Hyperf\Database\Model\Model;

class GoodsTimerDao extends AbstractDao
{
    protected string|Model $model = GoodsTimer::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '商品定时不存在或已删除';

    public function info(int $id, array $with = []): GoodsTimer
    {
        return parent::info($id, $with);
    }
}

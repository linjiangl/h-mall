<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Product;

use App\Core\Dao\AbstractDao;
use App\Model\Product\ProductTimer;
use Hyperf\Database\Model\Model;

class ProductTimerDao extends AbstractDao
{
    protected string|Model $model = ProductTimer::class;

    protected string $notFoundMessage = '商品定时不存在或已删除';

    public function info(int $id, array $with = []): ProductTimer
    {
        return parent::info($id, $with);
    }
}

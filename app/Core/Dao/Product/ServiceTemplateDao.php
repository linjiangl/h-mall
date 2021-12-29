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
use App\Model\Product\ServiceTemplate;
use Hyperf\Database\Model\Model;

class ServiceTemplateDao extends AbstractDao
{
    protected string|Model $model = ServiceTemplate::class;

    protected string $notFoundMessage = '服务模版不存在或已删除';

    public function info(int $id, array $with = []): ServiceTemplate
    {
        return parent::info($id, $with);
    }
}

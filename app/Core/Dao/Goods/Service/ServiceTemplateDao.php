<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Goods\Service;

use App\Core\Dao\AbstractDao;
use App\Model\Goods\ServiceTemplate;

class ServiceTemplateDao extends AbstractDao
{
    protected string $model = ServiceTemplate::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '服务模版不存在或已删除';

    public function info(int $id, array $with = []): ServiceTemplate
    {
        return parent::info($id, $with);
    }
}

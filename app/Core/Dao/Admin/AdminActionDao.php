<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Admin;

use App\Core\Dao\AbstractDao;
use App\Model\Admin\AdminAction;
use Hyperf\Database\Model\Model;

class AdminActionDao extends AbstractDao
{
    protected string|Model $model = AdminAction::class;

    protected array $noAllowActions = [];

    protected bool $softDelete = true;

    public function info(int $id, array $with = []): AdminAction
    {
        return parent::info($id, $with);
    }
}

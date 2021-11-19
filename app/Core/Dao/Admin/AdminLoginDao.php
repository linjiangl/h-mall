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
use App\Model\Admin\AdminLogin;
use Hyperf\Database\Model\Model;

class AdminLoginDao extends AbstractDao
{
    protected string|Model $model = AdminLogin::class;

    public function info(int $id, array $with = []): AdminLogin
    {
        return parent::info($id, $with);
    }
}

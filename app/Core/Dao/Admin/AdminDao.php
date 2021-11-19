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
use App\Model\Admin\Admin;
use Hyperf\Database\Model\Model;

class AdminDao extends AbstractDao
{
    protected string|Model $model = Admin::class;

    protected string $notFoundMessage = '管理员不存在';

    /**
     * 创建管理员.
     */
    public function create(array $data): Admin
    {
        return parent::create($data);
    }

    public function info(int $id, array $with = []): Admin
    {
        return parent::info($id, $with);
    }

    public function getInfoByUsername(string $username, string $symbol = '='): Admin
    {
        return $this->getInfoByCondition([['username', $symbol, $username]]);
    }

    public function getInfoByMobile(string $mobile): Admin
    {
        return $this->getInfoByCondition([['mobile', '=', $mobile]]);
    }
}

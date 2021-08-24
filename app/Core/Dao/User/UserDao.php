<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\User;

use App\Core\Dao\AbstractDao;
use App\Model\User\User;
use Hyperf\Database\Model\Model;

class UserDao extends AbstractDao
{
    protected string|Model $model = User::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '用户不存在';

    protected string $authorizeColumn = 'id';

    /**
     * 创建用户.
     */
    public function create(array $data): User
    {
        return parent::create($data);
    }

    public function info(int $id, array $with = []): User
    {
        return parent::info($id, $with);
    }

    public function getInfoByUsername(string $username, string $symbol = '='): User
    {
        return $this->getInfoByCondition([['username', $symbol, $username]]);
    }

    public function getInfoByMobile(string $mobile): User
    {
        return $this->getInfoByCondition([['mobile', '=', $mobile]]);
    }
}

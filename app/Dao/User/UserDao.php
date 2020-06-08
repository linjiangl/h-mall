<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Dao\User;

use App\Dao\AbstractDao;
use App\Model\User\User;
use Hyperf\Utils\Str;

class UserDao extends AbstractDao
{
    const STATUS_PROCESSED = 0;
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    protected $model = User::class;
    protected $noAllowActions = [];
    protected $notFoundMessage = '用户不存在';

    public static function getStatusLabel()
    {
        return [
            self::STATUS_PROCESSED => '待审核',
            self::STATUS_ENABLED => '已启用',
            self::STATUS_DISABLED => '已禁用',
        ];
    }

    public function getInfoByUsername($username, $symbol = '=')
    {
        return $this->getInfoByCondition([['username', $symbol, $username]]);
    }

    public function getInfoByMobile($mobile)
    {
        return $this->getInfoByCondition([['mobile', '=', $mobile]]);
    }
}

<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace  App\Dao\User;

use App\Dao\AbstractDao;
use App\Model\User\User;

class UserDao extends AbstractDao
{
    // 状态
    const STATUS_OPEN = 1;
    const STATUS_CLOSE = 0;

    protected $model = User::class;

    public static function getStatusLabel()
    {
        return [
            self::STATUS_CLOSE => '关闭',
            self::STATUS_OPEN => '开启'
        ];
    }

}

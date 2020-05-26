<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Dao\Admin;

use App\Dao\AbstractDao;
use App\Model\Admin;
use Hyperf\Utils\Str;

class AdminDao extends AbstractDao
{
    const STATUS_PROCESSED = 0;
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    protected $model = Admin::class;

    protected $noAllowActions = [];

    public static function getStatusLabel()
    {
        return [
            self::STATUS_PROCESSED => '待审核',
            self::STATUS_ENABLED => '已启用',
            self::STATUS_DISABLED => '已禁用',
        ];
    }

    public function generateSalt()
    {
        return Str::random(10);
    }

    public function generatePasswordHash($password, $salt = '')
    {
        if ($salt == '') {
            $salt = $this->generateSalt();
        }
        return sha1(substr(md5($password), 0, 16) . $salt);
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

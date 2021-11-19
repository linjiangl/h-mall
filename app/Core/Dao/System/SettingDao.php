<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\System;

use App\Core\Dao\AbstractDao;
use App\Model\Setting;
use Hyperf\Database\Model\Model;

class SettingDao extends AbstractDao
{
    protected string|Model $model = Setting::class;

    protected string $notFoundMessage = '配置不存在';

    public function getInfoByKey(string $key): Setting
    {
        return $this->getInfoByCondition([['key', '=', $key]]);
    }
}

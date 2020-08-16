<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\System;

use App\Core\Dao\AbstractDao;
use App\Model\Setting;

class SettingDao extends AbstractDao
{
    protected $model = Setting::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '配置不存在';

    public function getInfoByKey(string $key): Setting
    {
        return $this->getInfoByCondition([['key', '=', $key]]);
    }
}

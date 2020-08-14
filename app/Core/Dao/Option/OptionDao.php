<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Option;

use App\Core\Dao\AbstractDao;
use App\Model\Option\Option;

class OptionDao extends AbstractDao
{
    protected $model = Option::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '规格项不存在或已删除';
}

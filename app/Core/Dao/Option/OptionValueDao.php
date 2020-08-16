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
use App\Model\Option\OptionValue;

class OptionValueDao extends AbstractDao
{
    protected $model = OptionValue::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '规格值不存在或已删除';
}

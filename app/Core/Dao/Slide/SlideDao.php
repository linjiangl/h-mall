<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Slide;

use App\Core\Dao\AbstractDao;
use App\Model\Slide;

class SlideDao extends AbstractDao
{
    protected $model = Slide::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '幻灯片不存在或已删除';
}

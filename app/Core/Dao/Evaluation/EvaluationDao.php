<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Evaluation;

use App\Core\Dao\AbstractDao;
use App\Model\Order\OrderComment;

class EvaluationDao extends AbstractDao
{
    protected $model = OrderComment::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '评价不存在或已删除';
}

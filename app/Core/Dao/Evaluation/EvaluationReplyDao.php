<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Evaluation;

use App\Core\Dao\AbstractDao;
use App\Model\Evaluation\EvaluationReply;

class EvaluationReplyDao extends AbstractDao
{
    protected string $model = EvaluationReply::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '评价回复不存在或已删除';
}

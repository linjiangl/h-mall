<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\User;

use App\Core\Dao\AbstractDao;
use App\Model\User\UserVipCard;
use Hyperf\Database\Model\Model;

class UserVipCardDao extends AbstractDao
{
    protected string|Model $model = UserVipCard::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '会员卡未申请或已注销';
}

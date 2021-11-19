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
use App\Model\User\UserFavorite;
use Hyperf\Database\Model\Model;

class UserFavoriteDao extends AbstractDao
{
    protected string|Model $model = UserFavorite::class;

    protected string $notFoundMessage = '收藏记录不存在';
}

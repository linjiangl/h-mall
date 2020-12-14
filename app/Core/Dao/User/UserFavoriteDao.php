<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\User;

use App\Core\Dao\AbstractDao;
use App\Model\User\UserFavorite;

class UserFavoriteDao extends AbstractDao
{
    protected string $model = UserFavorite::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '收藏记录不存在';
}

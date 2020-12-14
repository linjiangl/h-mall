<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Message;

use App\Core\Dao\AbstractDao;
use App\Model\Message\Message;

class MessageDao extends AbstractDao
{
    protected string $model = Message::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '消息不存在';
}

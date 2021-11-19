<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Message;

use App\Core\Dao\AbstractDao;
use App\Model\Message\MessageReceiver;
use Hyperf\Database\Model\Model;

class MessageReceiverDao extends AbstractDao
{
    protected string|Model $model = MessageReceiver::class;

    protected string $notFoundMessage = '用户消息不存在';
}

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
use App\Model\Message\Message;
use Hyperf\Database\Model\Model;

class MessageDao extends AbstractDao
{
    protected string|Model $model = Message::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '消息不存在';
}

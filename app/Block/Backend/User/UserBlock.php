<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Block\Backend\User;

use App\Block\AbstractBlock;
use App\Core\Service\User\UserService;

class UserBlock extends AbstractBlock
{
    protected $query = [
        'like' => ['username']
    ];

    protected $service = UserService::class;
}

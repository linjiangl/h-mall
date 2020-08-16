<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Backend\User;

use App\Core\Block\Backend\BackendBlock;
use App\Core\Service\User\UserService;

class UserBlock extends BackendBlock
{
    protected $query = [
        '=' => ['id'],
        'like' => ['username'],
        'in' => ['status'],
        'between' => ['created_at']
    ];

    protected $paramType = [];

    protected $service = UserService::class;
}

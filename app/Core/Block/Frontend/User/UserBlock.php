<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Frontend\User;

use App\Core\Block\Frontend\FrontendBlock;
use App\Core\Service\User\UserService;

class UserBlock extends FrontendBlock
{
    protected $with = [];

    protected $query = [
        'like' => ['username']
    ];

    protected $service = UserService::class;
}
